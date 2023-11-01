const state = {
    user: {
        token: sessionStorage.getItem('TOKEN'),
        data: {}
    },
    products: {
        loading: false,
        data: [],
        llinks: [],
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
        llinks: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    },
    materials: {
        loading: false,
        data: [],
        llinks: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    },
    units: {
        loading: false,
        data: [],
        llinks: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    },
    colors: {
        loading: false,
        data: [],
        llinks: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    },
    threadDensities: {
        loading: false,
        data: [],
        llinks: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    },
    threadDirections: {
        loading: false,
        data: [],
        llinks: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    }
};

export default state;