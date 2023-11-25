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

export function setOptionCategories(state, [loading, response = null]) {
    if (response) {
        state.categories = {
            data: response.data,
        };
    }
    state.categories.loading = loading;
}

export function setOptionTypes(state, [loading, response = null]) {
    if (response) {
        state.types = {
            data: response.data,
        };
    }
    state.types.loading = loading;
}

export function setOptionUnits(state, [loading, response = null]) {
    if (response) {
        state.units = {
            data: response.data,
        };
    }
    state.units.loading = loading;
}

export function setOptionMaterials(state, [loading, response = null]) {
    if (response) {
        state.materials = {
            data: response.data,
        };
    }
    state.materials.loading = loading;
}

export function setOptionColors(state, [loading, response = null]) {
    if (response) {
        state.colors = {
            data: response.data,
        };
    }
    state.colors.loading = loading;
}

export function setOptionThreadDensities(state, [loading, response = null]) {
    if (response) {
        state.threadDensities = {
            data: response.data,
        };
    }
    state.threadDensities.loading = loading;
}

export function setOptionThreadDirections(state, [loading, response = null]) {
    if (response) {
        state.threadDirections = {
            data: response.data,
        };
    }
    state.threadDirections.loading = loading;
}

export function setProducts(state, [loading, data = null]) {
    if (data) {
        state.products = {
            ...state.products,
            data: data.data,
            links: data.meta.links,
            page: data.meta.current_page,
            limit: data.meta.per_page,
            from: data.meta.from,
            to: data.meta.to,
            total: data.meta.total,
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

export function setOrders(state, [loading, data = null]) {
    if (data) {
        state.orders = {
            ...state.orders,
            data: data.data,
            links: data.meta?.links,
            page: data.meta.current_page,
            limit: data.meta.per_page,
            from: data.meta.from,
            to: data.meta.to,
            total: data.meta.total,
        }
    }
    state.orders.loading = loading;
}

export function showToast(state, message) {
    state.toast.show = true;
    state.toast.message = message;
}

export function hideToast(state) {
    state.toast.show = false;
    state.toast.message = '';
}