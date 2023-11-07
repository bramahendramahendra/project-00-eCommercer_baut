import axiosClient from "../axios";

export function getUser({ commit }, data) {
    return axiosClient.get('/user', data)
        .then(({ data }) => {
            // debugger;
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

export function getProducts({ commit }, { url = null, search = '', perPage = 10, sort_field, sort_direction } = {}) {
    commit('setProducts', [true])
    url = url || '/products';
    // debugger
    // return axiosClient.get('product')
    return axiosClient.get(url, {
        params: {
            search,
            per_page: perPage,
            sort_field,
            sort_direction
        }
    })
        .then(res => {
            commit('setProducts', [false, res.data])
        })
        .catch(() => {
            commit('setProducts', [false])
        })
}

export function getTypes({ commit }, { url = null, search = '', perPage = 10, sort_field, sort_direction } = {}) {
    commit('setTypes', [true])
    url = url || '/types';
    // return axiosClient.get('type')
    return axiosClient.get(url, {
        params: {
            search,
            per_page: perPage,
            sort_field,
            sort_direction
        }
    })
        .then(res => {
            commit('setTypes', [false, res.data])
        })
        .catch(() => {
            commit('setTypes', [false])
        })
}

export function getCategories({ commit }, { url = null, search = '', perPage = 10, sort_field, sort_direction } = {}) {
    commit('setCategories', [true])
    url = url || '/categories';
    return axiosClient.get(url, {
        params: {
            search,
            per_page: perPage,
            sort_field,
            sort_direction
        }
    })
        .then(res => {
            commit('setCategories', [false, res.data])
        })
        .catch(() => {
            commit('setCategories', [false])
        })
}

export function getMaterials({ commit }, { url = null, search = '', perPage = 10, sort_field, sort_direction } = {}) {
    commit('setMaterials', [true])
    url = url || '/materials';
    // return axiosClient.get('material')
    return axiosClient.get(url, {
        params: {
            search,
            per_page: perPage,
            sort_field,
            sort_direction
        }
    })
        .then(res => {
            commit('setMaterials', [false, res.data])
        })
        .catch(() => {
            commit('setMaterials', [false])
        })
}

export function getUnits({ commit }, { url = null, search = '', perPage = 10, sort_field, sort_direction } = {}) {
    commit('setUnits', [true])
    url = url || '/units';
    // return axiosClient.get('unit')
    return axiosClient.get(url, {
        params: {
            search,
            per_page: perPage,
            sort_field,
            sort_direction
        }
    })
        .then(res => {
            commit('setUnits', [false, res.data])
        })
        .catch(() => {
            commit('setUnits', [false])
        })
}

export function getColors({ commit }, { url = null, search = '', perPage = 10, sort_field, sort_direction } = {}) {
    commit('setColors', [true])
    url = url || '/colors';
    // return axiosClient.get('color')
    return axiosClient.get(url, {
        params: {
            search,
            per_page: perPage,
            sort_field,
            sort_direction
        }
    })
        .then(res => {
            commit('setColors', [false, res.data])
        })
        .catch(() => {
            commit('setColors', [false])
        })
}

export function getThreadDensities({ commit }, { url = null, search = '', perPage = 10, sort_field, sort_direction } = {}) {
    commit('setThreadDensities', [true])
    url = url || '/threadDensities';
    // return axiosClient.get('threadDensity')
    return axiosClient.get(url, {
        params: {
            search,
            per_page: perPage,
            sort_field,
            sort_direction
        }
    })
        .then(res => {
            commit('setThreadDensities', [false, res.data])
        })
        .catch(() => {
            commit('setThreadDensities', [false])
        })
}

export function getThreadDirections({ commit }, { url = null, search = '', perPage = 10, sort_field, sort_direction } = {}) {
    commit('setThreadDirections', [true])
    url = url || '/threadDirections';
    // return axiosClient.get('threadDirection')
    return axiosClient.get(url, {
        params: {
            search,
            per_page: perPage,
            sort_field,
            sort_direction
        }
    })
        .then(res => {
            commit('setThreadDirections', [false, res.data])
        })
        .catch(() => {
            commit('setThreadDirections', [false])
        })
}

export function getProduct({ }, id) {
    return axiosClient.get(`/products/${id}`)
}

export function getType({ }, id) {
    return axiosClient.get(`/types/${id}`)
}

export function getCategory({ }, id) {
    return axiosClient.get(`/categories/${id}`)
}

export function getMaterial({ }, id) {
    return axiosClient.get(`/materials/${id}`)
}

export function getUnit({ }, id) {
    return axiosClient.get(`/units/${id}`)
}

export function getColor({ }, id) {
    return axiosClient.get(`/colors/${id}`)
}

export function getThreadDensity({ }, id) {
    return axiosClient.get(`/threadDensities/${id}`)
}

export function getThreadDirection({ }, id) {
    return axiosClient.get(`/threadDirections/${id}`)
}

export function createProduct({ commit }, product) {
    if (product.image instanceof File) {
        const form = new FormData();
        // form.append('type_id', product.type_id);
        form.append('code', product.code);
        form.append('title', product.title);
        form.append('image', product.image);
        form.append('description', product.description);
        form.append('price_retail', product.price_retail);
        product = form;
    }

    return axiosClient.post('/products', product)
}

export function createType({ commit }, type) {
    // if(type.)
    const form = new FormData();
    form.append('category_id', type.category_id);
    form.append('code', type.code);
    form.append('name', type.name);
    form.append('description', type.description);
    type = form;

    return axiosClient.post('/types', type)
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

export function createMaterial({ commit }, material) {
    // if(material.)
    const form = new FormData();
    form.append('name', material.name);
    material = form;

    return axiosClient.post('/materials', material)
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

export function createColor({ commit }, color) {
    // if(color.)
    const form = new FormData();
    form.append('name', color.name);
    color = form;

    return axiosClient.post('/colors', color)
}

export function createThreadDensity({ commit }, threadDensity) {
    // if(threadDensity.)
    const form = new FormData();
    form.append('name', threadDensity.name);
    threadDensity = form;

    return axiosClient.post('/threadDensities', threadDensity)
}

export function createThreadDirection({ commit }, threadDirection) {
    // if(threadDirection.)
    const form = new FormData();
    form.append('name', threadDirection.name);
    threadDirection = form;

    return axiosClient.post('/threadDirections', threadDirection)
}

export function updateProduct({ commit }, product) {
    const id = product.id

    if (product.image instanceof File) {
        const form = new FormData();
        form.append('id', product.id);
        // form.append('type_id', product.type_id);
        form.append('code', product.code);
        form.append('title', product.name);
        form.append('image', product.image);
        form.append('description', product.description);
        form.append('price_retail', product.price_retail);
        form.append('_method', 'PUT');
        product = form;
    } else {
        product._method = 'PUT'
    }

    return axiosClient.post(`/products/${id}`, product)
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

export function updateMaterial({ commit }, material) {
    const id = material.id

    const form = new FormData();
    form.append('id', material.id);
    form.append('name', material.name);
    form.append('_method', 'PUT');
    material = form;

    return axiosClient.post(`/materials/${id}`, material)
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

export function updateColor({ commit }, color) {
    const id = color.id

    const form = new FormData();
    form.append('id', color.id);
    form.append('name', color.name);
    form.append('_method', 'PUT');
    color = form;

    return axiosClient.post(`/colors/${id}`, color)
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

export function deleteProduct({ commit }, id) {
    // return axiosClient.delete('/categories/${id}')
    return axiosClient.delete(`/products/${id}`)
}

export function deleteType({ commit }, id) {
    // return axiosClient.delete('/categories/${id}')
    return axiosClient.delete(`/types/${id}`)
}

export function deleteCategory({ commit }, id) {
    // return axiosClient.delete('/categories/${id}')
    return axiosClient.delete(`/categories/${id}`)
}

export function deleteMaterial({ commit }, id) {
    // return axiosClient.delete('/categories/${id}')
    return axiosClient.delete(`/materials/${id}`)
}

export function deleteUnit({ commit }, id) {
    // return axiosClient.delete('/categories/${id}')
    return axiosClient.delete(`/units/${id}`)
}

export function deleteColor({ commit }, id) {
    // return axiosClient.delete('/categories/${id}')
    return axiosClient.delete(`/colors/${id}`)
}

export function deleteThreadDensity({ commit }, id) {
    // return axiosClient.delete('/categories/${id}')
    return axiosClient.delete(`/threadDensities/${id}`)
}

export function deleteThreadDirection({ commit }, id) {
    // return axiosClient.delete('/categories/${id}')
    return axiosClient.delete(`/threadDirections/${id}`)
}