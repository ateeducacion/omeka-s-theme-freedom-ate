const resourceLinkInfoScript = () => {

    // Adds a '+' button next to each .resource-link that fetches and shows
    // the linked resource's description as an inline accordion panel.
    // Uses MutationObserver to also handle links injected dynamically (e.g. faceted-browse AJAX).

    // Replaces the panel content with a single element holding plain text.
    // Values coming from the API are always set through textContent, never
    // concatenated into HTML, so markup in a description cannot execute.
    function setPanelMessage(panel, tagName, className, text) {
        const el = document.createElement(tagName);
        if (className) {
            el.className = className;
        }
        el.textContent = text;
        panel.textContent = '';
        panel.appendChild(el);
    }

    function processLink(link) {
        // Skip if already processed
        if (link.closest('.resource-link-info')) return;

        // Only process links that contain the o-icon-items span (Omeka-S linked resource icon)
        if (!link.querySelector('span.o-icon-items')) return;

        const href = link.getAttribute('href');
        if (!href) return;

        // Extract item ID from URL paths like /s/site-slug/item/28963
        const match = href.match(/\/item(?:s)?\/(\d+)/);
        if (!match) return;

        const itemId = match[1];
        const wrapper = document.createElement('span');
        wrapper.className = 'resource-link-info';

        // Move the link inside the wrapper
        link.parentNode.insertBefore(wrapper, link);
        wrapper.appendChild(link);

        // Create the toggle button
        const toggleBtn = document.createElement('button');
        toggleBtn.type = 'button';
        toggleBtn.className = 'resource-link-info__btn';
        toggleBtn.setAttribute('aria-expanded', 'false');
        toggleBtn.setAttribute('aria-label', 'Show resource info');
        toggleBtn.textContent = '+';
        wrapper.appendChild(toggleBtn);

        // Create the accordion panel
        const panel = document.createElement('div');
        panel.className = 'resource-link-info__panel';
        panel.style.maxHeight = '0';
        setPanelMessage(panel, 'span', 'resource-link-info__loading', '…');
        wrapper.appendChild(panel);

        let loaded = false;

        toggleBtn.addEventListener('click', function () {
            const isExpanded = toggleBtn.getAttribute('aria-expanded') === 'true';

            if (isExpanded) {
                panel.style.maxHeight = '0';
                toggleBtn.setAttribute('aria-expanded', 'false');
                toggleBtn.textContent = '+';
                wrapper.classList.remove('expanded');
            } else {
                panel.style.maxHeight = panel.scrollHeight + 'px';
                toggleBtn.setAttribute('aria-expanded', 'true');
                toggleBtn.textContent = '−';
                wrapper.classList.add('expanded');

                if (!loaded) {
                    loaded = true;
                    // The link href carries the installation base path
                    // (/subdir/s/slug/item/123), so derive it instead of
                    // assuming Omeka lives at the domain root.
                    const siteMatch = href.match(/^(.*?)\/s\//);
                    const basePath = siteMatch ? siteMatch[1] : '';

                    fetch(basePath + '/api/items/' + itemId)
                        .then(function (res) { return res.json(); })
                        .then(function (data) {
                            const descriptions = data['dcterms:description'];
                            if (descriptions && descriptions.length > 0) {
                                const fragment = document.createDocumentFragment();
                                descriptions.forEach(function (desc) {
                                    const p = document.createElement('p');
                                    p.textContent = desc['@value'] || '';
                                    fragment.appendChild(p);
                                });
                                panel.textContent = '';
                                panel.appendChild(fragment);
                            } else {
                                setPanelMessage(panel, 'p', 'resource-link-info__empty', '—');
                            }
                            // Recalculate height after content is set
                            panel.style.maxHeight = panel.scrollHeight + 'px';
                        })
                        .catch(function () {
                            setPanelMessage(panel, 'p', 'resource-link-info__error', 'Error loading info.');
                            panel.style.maxHeight = panel.scrollHeight + 'px';
                        });
                }
            }
        });
    }

    function processLinks(root) {
        root.querySelectorAll('a.resource-link').forEach(processLink);
    }

    // Process links present on initial page load
    processLinks(document);

    // Watch for dynamically injected content (e.g. faceted-browse AJAX results)
    const observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (mutation) {
            mutation.addedNodes.forEach(function (node) {
                if (node.nodeType !== Node.ELEMENT_NODE) return;
                // Check if the node itself is a resource-link
                if (node.matches('a.resource-link')) {
                    processLink(node);
                }
                // Check descendants
                processLinks(node);
            });
        });
    });

    observer.observe(document.body, { childList: true, subtree: true });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', resourceLinkInfoScript);
} else {
    resourceLinkInfoScript();
}
