<?php
namespace OmekaTheme\Helper;

use Laminas\View\Helper\AbstractHelper;

/**
 * View helper that checks if a user can edit content in the current site.
 *
 * Verifies permissions by checking:
 * 1. If the user is a global_admin (always allowed)
 * 2. If the user has 'admin' or 'editor' role in the current site
 *
 * Results are cached per user ID for the duration of the request,
 * so multiple calls from different templates won't trigger extra API queries.
 *
 * Usage in templates:
 *   if ($this->canEditInCurrentSite()):
 *       // show toolbox
 *   endif;
 *
 *   // Or with a specific user:
 *   if ($this->canEditInCurrentSite($someUser)):
 *       // show toolbox
 *   endif;
 */
class CanEditInCurrentSite extends AbstractHelper
{
    /**
     * Cached results keyed by user ID.
     *
     * @var array<int, bool>
     */
    private $cache = [];

    /**
     * Site roles that grant edit permissions.
     */
    private const EDITABLE_ROLES = ['admin', 'editor'];

    /**
     * Check if the given (or current) user can edit in the current site.
     *
     * @param object|null $user A user entity. If null, uses the current identity.
     * @return bool
     */
    public function __invoke($user = null)
    {
        $view = $this->getView();

        if ($user === null) {
            $user = $view->identity();
        }

        if (!$user) {
            return false;
        }

        $userId = $user->getId();

        if (array_key_exists($userId, $this->cache)) {
            return $this->cache[$userId];
        }

        $this->cache[$userId] = $this->checkPermission($user);

        return $this->cache[$userId];
    }

    /**
     * Perform the actual permission check.
     *
     * @param object $user
     * @return bool
     */
    private function checkPermission($user)
    {
        // Global admins can always edit
        if ($user->getRole() === 'global_admin') {
            return true;
        }

        try {
            $view = $this->getView();
            $currentSite = $view->currentSite();

            $siteData = $view->api()
                ->read('sites', $currentSite->id())
                ->getContent();

            $sitePermissions = $siteData->sitePermissions();

            foreach ($sitePermissions as $permission) {
                if ($permission->user()->id() === $user->getId()
                    && in_array($permission->role(), self::EDITABLE_ROLES, true)
                ) {
                    return true;
                }
            }
        } catch (\Exception $e) {
            // On any error, deny access
        }

        return false;
    }
}
