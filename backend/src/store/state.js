const state = {
    user: {
        token: sessionStorage.getItem('TOKEN'),
        data: {}
    },
    products: {
        loading: false,
        data: [],
        link: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    },
    types: {
        loading: false,
        data: [],
        llinks: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    },
    categories: {
        loading: false,
        data: [],
        link: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    },
    materials: {
        loading: false,
        data: [],
        link: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    },
    units: {
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    },
    colors: {
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    },
    threadDensities: {
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    },
    threadDirections: {
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    },
    orders: {
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    }, 
    users: {
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    },
    toast: {
        show: false,
        message: '',
        delay: 5000
    }
};

export default state;