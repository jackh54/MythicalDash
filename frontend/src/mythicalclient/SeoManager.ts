class SeoManager {

    static setFavicon(url: string) {
        const link: HTMLLinkElement = document.createElement('link');
        link.rel = 'icon';
        link.href = url;

        const existingLink = document.querySelector("link[rel='icon']");
        if (existingLink) {
            document.head.removeChild(existingLink);
        }

        document.head.appendChild(link);
    }

    static setTitle(title: string) {
        document.title = title;
        SeoManager.setOgTitle(title);
        SeoManager.setMetaTag('og:type', 'website');
        SeoManager.setTwitterCard('summary_large_image');
        SeoManager.setTwitterTitle(title);
    }

    static setDescription(description: string) {
        SeoManager.setMetaTag('description', description);
        SeoManager.setOgDescription(description);
        SeoManager.setTwitterDescription(description);
    }

    static setTwitterCard(cardType: string) {
        SeoManager.setMetaTag('twitter:card', cardType);
    }

    static setTwitterTitle(title: string) {
        SeoManager.setMetaTag('twitter:title', title);
    }

    static setTwitterDescription(description: string) {
        SeoManager.setMetaTag('twitter:description', description);
    }

    static setTwitterImage(imageUrl: string) {
        SeoManager.setMetaTag('twitter:image', imageUrl);
    }

    static setOgTitle(title: string) {
        SeoManager.setMetaProperty('og:title', title);
    }

    static setOgDescription(description: string) {
        SeoManager.setMetaProperty('og:description', description);
    }

    static setOgImage(imageUrl: string) {
        SeoManager.setMetaProperty('og:image', imageUrl);
    }

    static setOgUrl(url: string) {
        SeoManager.setMetaProperty('og:url', url);
    }

    static setKeywords(keywords: string) {
        SeoManager.setMetaTag('keywords', keywords);
    }

    static setAuthor(author: string) {
        SeoManager.setMetaTag('author', author);
    }

    private static setMetaTag(name: string, content: string) {
        let meta = document.querySelector(`meta[name='${name}']`) as HTMLMetaElement | null;
        if (!meta) {
            meta = document.createElement('meta');
            meta.name = name;
            document.head.appendChild(meta);
        }
        meta.content = content;
    }

    private static setMetaProperty(property: string, content: string) {
        let meta = document.querySelector(`meta[property='${property}']`);
        if (!meta) {
            meta = document.createElement('meta');
            meta.setAttribute('property', property);
            document.head.appendChild(meta);
        }
        (meta as HTMLMetaElement).content = content;
    }
}

export default SeoManager;
