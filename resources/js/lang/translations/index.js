export default {
    uk: {
        name: 'Українська',
        load: () => { return import('./uk.json'); },
    },
    en: {
        name: 'English',
        load: () => { return import('./en.json'); },
    },
};
