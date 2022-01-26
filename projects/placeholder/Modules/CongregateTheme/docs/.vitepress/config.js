import { defineConfig} from 'vitepress'

export default defineConfig({
    title: "Congregate Theme Module",
    description: "The manages theming of a website",
    base: '/congregate_theme/',

    themeConfig: {
        repo: 'wychrist/congregate_theme/',
        docsDir: 'docs',
        docsBranch: 'main',
        editLinks: true,
        editLinkText: 'Edit this on Github',
        lastUpdated: 'Last Updated',

        nav: [
            { text: 'Guide', link: '/', activeMatch: '^/$|^/guide' },
            { text: 'Config Reference', link: '/config/basics', activeMatch: '^/config/' }
        ],
        sidebar: {
            '/guide/': getGuideSidebar(),
            '/config/': getConfigSidebar(),
            '/': getGuideSidebar()
        }
    }
})


function getGuideSidebar() {
    return [
        {
            text: 'Introduction',
            children: [
                { text: 'What is Congregate Theme?', link: '/' },
            ]
        },
        {
            text: 'Advanced',
            children: [
                { text: 'Create a theme', link: '/guide/create_theme' }
            ]
        }
    ];
}

function getConfigSidebar() {
    return [
        {
            text: 'Configuration',
            children: [
                { text: 'Basics', link: '/config/basics' }
            ]
        },
    ];
}
