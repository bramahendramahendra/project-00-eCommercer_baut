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
}

export function setTypes(state, [loading, data = null]) {
    if (data) {
        state.types = {
            ...state.types,
            data: data.data,
            links: data.meta?.links,
            page: data.meta.current_page,
            limit: data.meta.per_page,
            from: data.meta.from,
            to: data.meta.to,
            total: data.meta.total,
        }
    }
    state.types.loading = loading;
}

export function setCategories(state, [loading, data = null]) {
    if (data) {
        state.categories = {
            ...state.categories,
            data: data.data,
            links: data.meta?.links,
            page: data.meta.current_page,
            limit: data.meta.per_page,
            from: data.meta.from,
            to: data.meta.to,
            total: data.meta.total,
        }
    }
    state.categories.loading = loading;
}

export function setMaterials(state, [loading, data = null]) {
    if (data) {
        state.materials = {
            ...state.materials,
            data: data.data,
            links: data.meta?.links,
            page: data.meta.current_page,
            limit: data.meta.per_page,
            from: data.meta.from,
            to: data.meta.to,
            total: data.meta.total,
        }
    }
    state.materials.loading = loading;
    // state.materials.data = data.data;
}

export function setUnits(state, [loading, data = null]) {
    if (data) {
        state.units = {
            ...state.units,
            data: data.data,
            links: data.meta?.links,
            total: data.meta.total,
            limit: data.meta.per_page,
            from: data.meta.from,
            to: data.meta.to,
            page: data.meta.current_page,
        }
    }
    state.units.loading = loading;
}

export function setColors(state, [loading, data = null]) {
    if (data) {
        state.colors = {
            ...state.colors,
            data: data.data,
            links: data.meta?.links,
            page: data.meta.current_page,
            limit: data.meta.per_page,
            from: data.meta.from,
            to: data.meta.to,
            total: data.meta.total,
        }
    }
    state.colors.loading = loading;
}

export function setThreadDensities(state, [loading, data = null]) {
    if (data) {
        state.threadDensities = {
            ...state.threadDensities,
            data: data.data,
            links: data.meta?.links,
            page: data.meta.current_page,
            limit: data.meta.per_page,
            from: data.meta.from,
            to: data.meta.to,
            total: data.meta.total,
        }
    }
    state.threadDensities.loading = loading;
}

export function setThreadDirections(state, [loading, data = null]) {
    if (data) {
        state.threadDirections = {
            ...state.threadDirections,
            data: data.data,
            links: data.meta?.links,
            page: data.meta.current_page,
            limit: data.meta.per_page,
            from: data.meta.from,
            to: data.meta.to,
            total: data.meta.total,
        }
    }
    state.threadDirections.loading = loading;
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

export function setUsers(state, [loading, data = null]) {
    if (data) {
        state.users = {
            ...state.users,
            data: data.data,
            links: data.meta?.links,
            page: data.meta.current_page,
            limit: data.meta.per_page,
            from: data.meta.from,
            to: data.meta.to,
            total: data.meta.total,
        }
    }
    state.users.loading = loading;
}

export function setCustomers(state, [loading, data = null]) {
    if (data) {
        state.customers = {
            ...state.customers,
            data: data.data,
            links: data.meta?.links,
            page: data.meta.current_page,
            limit: data.meta.per_page,
            from: data.meta.from,
            to: data.meta.to,
            total: data.meta.total,
        }
    }
    state.users.loading = loading;
}

export function setContactUses(state, [loading, data = null]) {
    if (data) {
        state.contactUses = {
            ...state.contactUses,
            data: data.data,
            links: data.meta?.links,
            page: data.meta.current_page,
            limit: data.meta.per_page,
            from: data.meta.from,
            to: data.meta.to,
            total: data.meta.total,
        }
    }
    state.contactUses.loading = loading;
}

export function setNewsletters(state, [loading, data = null]) {
    if (data) {
        state.newsletters = {
            ...state.newsletters,
            data: data.data,
            links: data.meta?.links,
            page: data.meta.current_page,
            limit: data.meta.per_page,
            from: data.meta.from,
            to: data.meta.to,
            total: data.meta.total,
        }
    }
    state.newsletters.loading = loading;
}

export function showToast(state, message) {
    state.toast.show = true;
    state.toast.message = message;
}

export function hideToast(state) {
    state.toast.show = false;
    state.toast.message = '';
}