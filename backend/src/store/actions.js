import axiosClient from "../axios";

export function getCurrentUser({ commit }, data) {
    return axiosClient.get('/user', data)
        .then(({ data }) => {
            commit('setUser', data);
            return data;
        })
}

export function login({ commit }, data) {
    return axiosClient.post('/login', data)
        .then(({ data }) => {
            commit('setUser', data.user);
            commit('setToken', data.token);
            return data;
        })
}

export function logout({ commit }) {
    return axiosClient.post('/logout')
        .then((response) => {
            commit('setToken', null)
            return response;
        })
}

export function getOptionCategories({ commit }) {
    return axiosClient.get('/categories/options')
}

export function getOptionTypes({ commit }) {
    return axiosClient.get(`/types/options`)
}

export function getOptionUnits({ commit }) {
    return axiosClient.get('/units/options')
}

export function getOptionMaterials({ commit }) {
    return axiosClient.get('/materials/options')
}

export function getOptionColors({ commit }) {
    return axiosClient.get('/colors/options')
}

export function getOptionThreadDensities({ commit }) {
    return axiosClient.get('/threadDensities/options')
}

export function getOptionThreadDirections({ commit }) {
    return axiosClient.get('/threadDirections/options')
}

export function getProducts({ commit, state }, { url = null, search = '', per_page, sort_field, sort_direction } = {}) {
    commit('setProducts', [true])
    url = url || '/products';
    const params = {
        per_page: state.products.limit,
    }
    return axiosClient.get(url, {
        params: {
            ...params, 
            search, per_page, sort_field, sort_direction
        }
    })
    .then(response => {
        commit('setProducts', [false, response.data])
    })
    .catch(() => {
        commit('setProducts', [false])
    })
}

export function getProduct({ commit }, id) {
    return axiosClient.get(`/products/${id}`)
}

export function createProduct({ commit }, product) {
    // debugger;
    if (product.image instanceof File) {
        const form = new FormData();
        form.append('type_id', product.type_id);
        form.append('code', product.code);
        form.append('title', product.title);
        // form.append('image', product.image);
        form.append('image', product.image);
        form.append('description', product.description || '');
        form.append('price_retail', product.price_retail);
        form.append('quantity_limit', product.quantity_limit);
        form.append('price_wholesale',product.price_wholesale);
        form.append('unit_id',product.unit_id);
        form.append('material_id',product.material_id);
        form.append('weight',product.weight);
        form.append('unit_weight_id',product.weight_unit_id);
        form.append('contents_per_box',product.contents_per_box);
        form.append('unit_contents_per_box_id',product.contents_per_box_unit_id);
        form.append('grade',product.grade);
        form.append('thread_direction_id',product.thread_direction_id);
        form.append('thread_density_id',product.thread_density_id);
        form.append('diameter',product.diameter);
        form.append('inner_diameter',product.inner_diameter);
        form.append('outer_diameter',product.outer_diameter);
        form.append('unit_diameter_id',product.diameter_unit_id);
        form.append('length',product.length);
        form.append('unit_length_id',product.length_unit_id);
        form.append('thick_head',product.thick_head);
        form.append('unit_thick_head_id',product.thick_head_unit_id);
        form.append('drat_length',product.drat_length);
        form.append('unit_drat_length_id',product.drat_length_unit_id);
        form.append('drat_size',product.drat_size);
        form.append('dimensional_standart',product.dimensional_standart);
        form.append('head_style',product.head_style);
        form.append('drive_type',product.drive_type);
        form.append('across_flats',product.across_flats);
        form.append('drat_type',product.drat_type);
        form.append('color_id',product.color_id);
        form.append('published', product.published ? 1 : 0);
        product = form;
    }

    return axiosClient.post('/products', product)
}

export function updateProduct({ commit }, product) {
    const id = product.id

    if (product.image instanceof File) {
        const form = new FormData();
        form.append('id', product.id);
        form.append('type_id', product.type_id);
        form.append('code', product.code);
        form.append('title', product.title);
        form.append('image', product.image);
        form.append('description', product.description || '');
        form.append('price_retail', product.price_retail);
        form.append('quantity_limit', product.quantity_limit);
        form.append('price_wholesale', product.price_wholesale);
        form.append('unit_id', product.unit_id);
        form.append('material_id', product.material_id);
        form.append('weight', product.weight);
        form.append('unit_weight_id', product.weight_unit_id);
        form.append('contents_per_box', product.contents_per_box);
        form.append('unit_contents_per_box_id', product.contents_per_box_unit_id);
        form.append('grade', product.grade);
        form.append('thread_direction_id', product.thread_direction_id);
        form.append('thread_density_id', product.thread_density_id);
        form.append('diameter', product.diameter);
        form.append('inner_diameter', product.inner_diameter);
        form.append('outer_diameter', product.outer_diameter);
        form.append('unit_diameter_id', product.diameter_unit_id);
        form.append('length', product.length);
        form.append('unit_length_id', product.length_unit_id);
        form.append('thick_head', product.thick_head);
        form.append('unit_thick_head_id', product.thick_head_unit_id);
        form.append('drat_length', product.drat_length);
        form.append('unit_drat_length_id', product.drat_length_unit_id);
        form.append('drat_size', product.drat_size);
        form.append('dimensional_standart', product.dimensional_standart);
        form.append('head_style', product.head_style);
        form.append('drive_type', product.drive_type);
        form.append('across_flats', product.across_flats);
        form.append('drat_type', product.drat_type);
        form.append('color_id', product.color_id);
        form.append('published', product.published?1:0);
        form.append('_method', 'PUT');
        product = form;
    } else {
        product._method = 'PUT'
    }

    return axiosClient.post(`/products/${id}`, product)
}

export function deleteProduct({ commit }, id) {
    // return axiosClient.delete('/categories/${id}')
    return axiosClient.delete(`/products/${id}`)
}

export function getTypes({ commit, state }, { url = null, search = '', per_page, sort_field, sort_direction } = {}) {
    commit('setTypes', [true])
    url = url || '/types';
    const params = {
        per_page: state.types.limit,
    }
    return axiosClient.get(url, {
        params: {
            ...params,
            search, per_page, sort_field, sort_direction
        }
    })
    .then(response => {
            commit('setTypes', [false, response.data])
    })
    .catch(() => {
        commit('setTypes', [false])
    })
}

export function getType({ commit }, id) {
    return axiosClient.get(`/types/${id}`)
}

export function createType({ commit }, type) {
    // if(type.)
    const form = new FormData();
    form.append('category_id', type.category_id);
    form.append('code', type.code);
    form.append('name', type.name);
    form.append('description', type.description);
    type = form;
    // console.log(type)
    // debugger;

    return axiosClient.post('/types', type)
}

export function updateType({ commit }, type) {
    const id = type.id

    const form = new FormData();
    form.append('category_id', type.category_id);
    form.append('id', type.id);
    form.append('code', type.code);
    form.append('name', type.name);
    form.append('description', type.description);
    form.append('_method', 'PUT');
    type = form;

    return axiosClient.post(`/types/${id}`, type)
}

export function deleteType({ commit }, id) {
    // return axiosClient.delete('/categories/${id}')
    return axiosClient.delete(`/types/${id}`)
}

export function getCategories({ commit, state }, { url = null, search = '', per_page, sort_field, sort_direction } = {}) {
    commit('setCategories', [true])
    url = url || '/categories';
    const params = {
        per_page: state.categories.limit,
    }
    return axiosClient.get(url, {
        params: {
            ...params,
            search, per_page, sort_field, sort_direction
        }
    })
    .then(response => {
        commit('setCategories', [false, response.data])
    })
    .catch(() => {
        commit('setCategories', [false])
    })
}

export function getCategory({ commit }, id) {
    return axiosClient.get(`/categories/${id}`)
}

export function createCategory({ commit }, category) {
    // if(category.)
    const form = new FormData();
    form.append('code', category.code);
    form.append('name', category.name);
    form.append('description', category.description);
    category = form;

    return axiosClient.post('/categories', category)
}

export function updateCategory({ commit }, category) {
    const id = category.id

    const form = new FormData();
    form.append('id', category.id);
    form.append('code', category.code);
    form.append('name', category.name);
    form.append('description', category.description);
    form.append('_method', 'PUT');
    category = form;

    return axiosClient.post(`/categories/${id}`, category)
}

export function deleteCategory({ commit }, id) {
    // return axiosClient.delete('/categories/${id}')
    return axiosClient.delete(`/categories/${id}`)
}

export function getMaterials({ commit, state }, { url = null, search = '', per_page, sort_field, sort_direction } = {}) {
    commit('setMaterials', [true])
    url = url || '/materials';
    const params = {
        per_page: state.materials.limit,
    }
    return axiosClient.get(url, {
        params: {
            ...params,
            search, per_page, sort_field, sort_direction
        }
    })
        .then(response => {
            commit('setMaterials', [false, response.data])
        })
        .catch(() => {
            commit('setMaterials', [false])
        })
}

export function getMaterial({ commit }, id) {
    return axiosClient.get(`/materials/${id}`)
}

export function createMaterial({ commit }, material) {
    // if(material.)
    const form = new FormData();
    form.append('name', material.name);
    material = form;
    console.log(material)
    // debugger;
    return axiosClient.post('/materials', material)
}

export function updateMaterial({ commit }, material) {
    const id = material.id

    const form = new FormData();
    form.append('id', material.id);
    form.append('name', material.name);
    form.append('_method', 'PUT');
    material = form;

    return axiosClient.post(`/materials/${id}`, material)
}

export function deleteMaterial({ commit }, id) {
    // return axiosClient.delete('/categories/${id}')
    return axiosClient.delete(`/materials/${id}`)
}

export function getUnits({ commit, state }, { url = null, search = '', per_page, sort_field, sort_direction } = {}) {
    commit('setUnits', [true])
    url = url || '/units';
    const params = {
        per_page: state.units.limit,
    }
    return axiosClient.get(url, {
        params: {
            ...params,
            search, per_page, sort_field, sort_direction
        }
    })
        .then(response => {
            commit('setUnits', [false, response.data])
        })
        .catch(() => {
            commit('setUnits', [false])
        })
}

export function getUnit({ commit }, id) {
    return axiosClient.get(`/units/${id}`)
}

export function createUnit({ commit }, unit) {
    // if(unit.)
    // debugger;
    const form = new FormData();
    form.append('short_name', unit.short_name);
    form.append('full_name', unit.full_name);
    form.append('symbol', unit.symbol);
    unit = form;

    return axiosClient.post('/units', unit)
}

export function updateUnit({ commit }, unit) {
    const id = unit.id

    const form = new FormData();
    form.append('id', unit.id);
    form.append('short_name', unit.short_name);
    form.append('full_name', unit.full_name);
    form.append('symbol', unit.symbol);
    form.append('_method', 'PUT');
    unit = form;

    return axiosClient.post(`/units/${id}`, unit)
}

export function deleteUnit({ commit }, id) {
    // return axiosClient.delete('/categories/${id}')
    return axiosClient.delete(`/units/${id}`)
}

export function getColors({ commit, state }, { url = null, search = '', per_page, sort_field, sort_direction } = {}) {
    commit('setColors', [true])
    url = url || '/colors';
    const params = {
        per_page: state.colors.limit,
    }
    return axiosClient.get(url, {
        params: {
            ...params,
            search, per_page, sort_field, sort_direction
        }
    })
        .then(res => {
            commit('setColors', [false, res.data])
        })
        .catch(() => {
            commit('setColors', [false])
        })
}

export function getColor({ commit }, id) {
    return axiosClient.get(`/colors/${id}`)
}

export function createColor({ commit }, color) {
    // if(color.)
    const form = new FormData();
    form.append('name', color.name);
    color = form;

    return axiosClient.post('/colors', color)
}

export function updateColor({ commit }, color) {
    const id = color.id

    const form = new FormData();
    form.append('id', color.id);
    form.append('name', color.name);
    form.append('_method', 'PUT');
    color = form;

    return axiosClient.post(`/colors/${id}`, color)
}

export function deleteColor({ commit }, id) {
    // return axiosClient.delete('/categories/${id}')
    return axiosClient.delete(`/colors/${id}`)
}

export function getThreadDensities({ commit, state }, { url = null, search = '', per_page, sort_field, sort_direction } = {}) {
    commit('setThreadDensities', [true])
    url = url || '/threadDensities';
    const params = {
        per_page: state.threadDensities.limit,
    }
    return axiosClient.get(url, {
        params: {
            ...params,
            search, per_page, sort_field, sort_direction
        }
    })
        .then(response => {
            commit('setThreadDensities', [false, response.data])
        })
        .catch(() => {
            commit('setThreadDensities', [false])
        })
}

export function getThreadDensity({ commit }, id) {
    return axiosClient.get(`/threadDensities/${id}`)
}

export function createThreadDensity({ commit }, threadDensity) {
    // if(threadDensity.)
    const form = new FormData();
    form.append('name', threadDensity.name);
    threadDensity = form;

    return axiosClient.post('/threadDensities', threadDensity)
}

export function updateThreadDensity({ commit }, threadDensity) {
    const id = threadDensity.id

    const form = new FormData();
    form.append('id', threadDensity.id);
    form.append('name', threadDensity.name);
    form.append('_method', 'PUT');
    threadDensity = form;

    return axiosClient.post(`/threadDensities/${id}`, threadDensity)
}

export function deleteThreadDensity({ commit }, id) {
    // return axiosClient.delete('/categories/${id}')
    return axiosClient.delete(`/threadDensities/${id}`)
}

export function getThreadDirections({ commit, state }, { url = null, search = '', per_page, sort_field, sort_direction } = {}) {
    commit('setThreadDirections', [true])
    url = url || '/threadDirections';
    const params = {
        per_page: state.threadDirections.limit,
    }
    return axiosClient.get(url, {
        params: {
            ...params,
            search, per_page, sort_field, sort_direction
        }
    })
        .then(response => {
            commit('setThreadDirections', [false, response.data])
        })
        .catch(() => {
            commit('setThreadDirections', [false])
        })
}

export function getThreadDirection({ commit }, id) {
    return axiosClient.get(`/threadDirections/${id}`)
}

export function createThreadDirection({ commit }, threadDirection) {
    // if(threadDirection.)
    const form = new FormData();
    form.append('name', threadDirection.name);
    threadDirection = form;

    return axiosClient.post('/threadDirections', threadDirection)
}

export function updateThreadDirection({ commit }, threadDirection) {
    const id = threadDirection.id

    const form = new FormData();
    form.append('id', threadDirection.id);
    form.append('code', threadDirection.code);
    form.append('name', threadDirection.name);
    form.append('description', threadDirection.description);
    form.append('_method', 'PUT');
    threadDirection = form;

    return axiosClient.post(`/threadDirections/${id}`, threadDirection)
}

export function deleteThreadDirection({ commit }, id) {
    // return axiosClient.delete('/categories/${id}')
    return axiosClient.delete(`/threadDirections/${id}`)
}

export function getOrders({ commit, state }, { url = null, search = '', per_page, sort_field, sort_direction } = {}) {
    commit('setOrders', [true])
    url = url || '/orders'
    const params = {
        per_page: state.orders.limit,
    }
    return axiosClient.get(url, {
        params: {
            ...params,
            search, per_page, sort_field, sort_direction
        }
    })
        .then((response) => {
            commit('setOrders', [false, response.data])
        })
        .catch(() => {
            commit('setOrders', [false])
        })
}

export function getOrder({ commit }, id) {
    return axiosClient.get(`/orders/${id}`)
}

export function getUsers({ commit, state }, { url = null, search = '', per_page, sort_field, sort_direction } = {}) {
    commit('setUsers', [true])
    url = url || '/users'
    const params = {
        per_page: state.users.limit,
    }
    return axiosClient.get(url, {
        params: {
            ...params,
            search, per_page, sort_field, sort_direction
        }
    })
        .then((response) => {
            commit('setUsers', [false, response.data])
        })
        .catch(() => {
            commit('setUsers', [false])
        })
}

export function getUser({ commit }, id) {
    return axiosClient.get(`/users/${id}`)
}

export function createUser({ commit }, user) {
    return axiosClient.post('/users', user)
}

export function updateUser({ commit }, user) {
    return axiosClient.put(`/users/${user.id}`, user)
}

export function deleteUser({ commit }, user) {
    // return axiosClient.delete('/categories/${id}')
    return axiosClient.delete(`/users/${user.id}`)
}

export function getCustomers({ commit, state }, { url = null, search = '', per_page, sort_field, sort_direction } = {}) {
    commit('setCustomers', [true])
    url = url || '/customers'
    const params = {
        per_page: state.customers.limit,
    }
    return axiosClient.get(url, {
        params: {
            ...params,
            search, per_page, sort_field, sort_direction
        }
    })
        .then((response) => {
            commit('setCustomers', [false, response.data])
        })
        .catch(() => {
            commit('setCustomers', [false])
        })
}

export function getCustomer({ commit }, id) {
    return axiosClient.get(`/customers/${id}`)
}

export function createCustomer({ commit }, customer) {
    return axiosClient.post('/users', customer)
}

export function updateCustomer({ commit }, customer) {
    return axiosClient.put(`/customers/${customer.id}`, customer)
}

export function deleteCustomer({commit}, customer) {
    return axiosClient.delete(`/customers/${customer.id}`)
}

export function getContactUses({ commit, state }, { url = null, search = '', per_page, sort_field, sort_direction } = {}) {
    commit('setContactUses', [true])
    url = url || '/contactUses'
    const params = {
        per_page: state.contactUses.limit,
    }
    return axiosClient.get(url, {
        params: {
            ...params,
            search, per_page, sort_field, sort_direction
        }
    })
        .then((response) => {
            commit('setContactUses', [false, response.data])
        })
        .catch(() => {
            commit('setContactUses', [false])
        })
}

export function getContactUs({ commit }, id) {
    // debugger;
    return axiosClient.get(`/contactUs/${id}`)
}

export function getNewsletters({ commit, state }, { url = null, search = '', per_page, sort_field, sort_direction } = {}) {
    commit('setNewsletters', [true])
    url = url || '/newsletters'
    const params = {
        per_page: state.newsletters.limit,
    }
    return axiosClient.get(url, {
        params: {
            ...params,
            search, per_page, sort_field, sort_direction
        }
    })
        .then((response) => {
            commit('setNewsletters', [false, response.data])
        })
        .catch(() => {
            commit('setNewsletters', [false])
        })
}