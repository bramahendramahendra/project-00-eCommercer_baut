export function setUser(state, user) {
    state.user.data = user;
}

export function setToken(state, token) {
    state.user.token = token;
    if (token) {
        sessionStorage.setItem('TOKEN', token);
    } else {
        sessionStorage.removeItem('TOKEN');
    }
}

export function setCategoriesLoading(state, isLoading) {
    state.categories.loading = isLoading;
}

export function setOptionCategories(state, [loading, response = null]) {
    if (response) {
        state.categories = {
            data: response.data,
        };
    }
    state.categories.loading = loading;
}

export function setProducts(state, [loading, response = null]) {
    if (response) {
        state.products = {
            data: response.data,
            links: response.meta.links,
            total: response.meta.total,
            limit: response.meta.per_page,
            from: response.meta.from,
            to: response.meta.to,
            page: response.meta.current_page,
        }
    }
    state.products.loading = loading;
    // state.products.data = response.data;
}

export function setTypes(state, [loading, response = null]) {
    if (response) {
        state.types = {
            data: response.data,
            links: response.meta.links,
            total: response.meta.total,
            limit: response.meta.per_page,
            from: response.meta.from,
            to: response.meta.to,
            page: response.meta.current_page,
        }
    }
    state.types.loading = loading;
    // state.types.data = response.data;
}

export function setCategories(state, [loading, response = null]) {
    if (response) {
        state.categories = {
            data: response.data,
            links: response.meta.links,
            total: response.meta.total,
            limit: response.meta.per_page,
            from: response.meta.from,
            to: response.meta.to,
            page: response.meta.current_page,
        }
    }
    state.categories.loading = loading;
}

export function setMaterials(state, [loading, response = null]) {
    if (response) {
        state.materials = {
            data: response.data,
            links: response.meta.links,
            total: response.meta.total,
            limit: response.meta.per_page,
            from: response.meta.from,
            to: response.meta.to,
            page: response.meta.current_page,
        }
    }
    state.materials.loading = loading;
    // state.materials.data = response.data;
}

export function setUnits(state, [loading, response = null]) {
    if (response) {
        state.units = {
            data: response.data,
            links: response.meta.links,
            total: response.meta.total,
            limit: response.meta.per_page,
            from: response.meta.from,
            to: response.meta.to,
            page: response.meta.current_page,
        }
    }
    state.units.loading = loading;
    // state.units.data = response.data;
}

export function setColors(state, [loading, response = null]) {
    if (response) {
        state.colors = {
            data: response.data,
            links: response.meta.links,
            total: response.meta.total,
            limit: response.meta.per_page,
            from: response.meta.from,
            to: response.meta.to,
            page: response.meta.current_page,
        }
    }
    state.colors.loading = loading;
    // state.colors.data = response.data;
}

export function setThreadDensities(state, [loading, response = null]) {
    if (response) {
        state.threadDensities = {
            data: response.data,
            links: response.meta.links,
            total: response.meta.total,
            limit: response.meta.per_page,
            from: response.meta.from,
            to: response.meta.to,
            page: response.meta.current_page,
        }
    }
    state.threadDensities.loading = loading;
    // state.threadDensities.data = response.data;
}

export function setThreadDirections(state, [loading, response = null]) {
    if (response) {
        state.threadDirections = {
            data: response.data,
            links: response.meta.links,
            total: response.meta.total,
            limit: response.meta.per_page,
            from: response.meta.from,
            to: response.meta.to,
            page: response.meta.current_page,
        }
    }
    state.threadDirections.loading = loading;
    // state.threadDirections.data = response.data;
}
