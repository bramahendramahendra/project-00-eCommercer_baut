import './bootstrap';

import Alpine from 'alpinejs';
import persist from '@alpinejs/persist'
import collapse from '@alpinejs/collapse'
import { get, post } from "./http.js";

Alpine.plugin(persist)
Alpine.plugin(collapse)

window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.data("toast", () => ({
        visible: false,
        delay: 5000,
        percent: 0,
        interval: null,
        timeout: null,
        message: null,
        close() {
            this.visible = false;
            clearInterval(this.interval);
        },
        show(message) {
            this.visible = true;
            this.message = message;

            if (this.interval) {
                clearInterval(this.interval);
                this.interval = null;
            }
            if (this.timeout) {
                clearTimeout(this.timeout);
                this.timeout = null;
            }
            this.timeout = setTimeout(() => {
                this.visible = false;
                this.timeout = null;
            }, this.delay);
            const startDate = Date.now();
            const futureDate = Date.now() + this.delay;
            this.interval = setInterval(() => {
                const date = Date.now();
                this.percent = ((date - startDate) * 100) / (futureDate - startDate);
                if (this.percent >= 100) {
                    clearInterval(this.interval);
                    this.interval = null;
                }
            }, 30);
        }
    }));

    Alpine.data('productItem', (product) => {
        return {
            product,
            addToCart(quantity = 1) {
                post(this.product.addToCartUrl, { quantity })
                    .then(result => {
                        // debugger;
                        this.$dispatch('cart-change', { count: result.count })
                        this.$dispatch("notify", {
                            message: "Produk anda ditambahkan ke keranjang",
                        });
                    })
                    .catch(response => {
                        console.log(response);
                        // this.$dispatch('notify', {
                        //     message: response.message || 'Server Error. Please try again.',
                        //     // type: 'error'
                        // })
                    })
            },
            removeItemFromCart() {
                post(this.product.removeUrl)
                    .then(result => {
                        this.$dispatch("notify", {
                            message: "Produk anda dihapus dari keranjang",
                        });
                        this.$dispatch('cart-change', { count: result.count })
                        this.cartItems = this.cartItems.filter(p => p.id !== product.id)
                    })
            },
            changeQuantity() {
                post(this.product.updateQuantityUrl, { quantity: product.quantity })
                    .then(result => {
                        this.$dispatch('cart-change', { count: result.count })
                        this.$dispatch("notify", {
                            message: "Jumlah Prodok diupdate",
                        });
                    })
            }
        };
    });

    Alpine.data('dropdown', () => ({
        categoryMenus: [],
        typeMenus: [],
        activeMenu: null,
        selectedMenu: null,
        showImage: false,
        tempSelectedType: null, // Menyimpan sementara accessory terpilih
        isMouseInType: false, 

        async init() {
            this.categoryMenus = JSON.parse(localStorage.getItem('categoryMenus')) || [];
            // localS torage.removeItem('categoryMenus');
            // Jika tidak ada data di local storage, panggil API
            if (this.categoryMenus.length === 0) {
                await this.fetchCategories();
            }

            // await this.fetchCategories();
        },

        async fetchCategories() {
            try {
                const response = await fetch('/menu-categories'); // Endpoint untuk API
                const categories = await response.json();
                this.categoryMenus = categories.map(category => ({
                    name: category.name,
                    slug: category.slug,
                    types: category.type
                        .filter(type => type.product && type.product.length > 0) // Filter jenis yang memiliki produk
                        .map(type => ({
                            name: type.name,
                            slug: type.slug,
                            image: type.product[0].image // Karena filter di atas, kita tahu setiap jenis memiliki produk
                        }))
                })).filter(category => category.types.length > 0); // Filter kategori yang memiliki jenis dengan produk

                // Simpan data ke local storage
                localStorage.setItem('categoryMenus', JSON.stringify(this.categoryMenus));
            } catch (error) {
                console.error('Error fetching categories:', error);
            }
        },

        // async fetchCategories() {
        //     try {
        //         const response = await fetch('/menu-categories'); // Endpoint untuk API
        //         const categories = await response.json();
        //         this.categoryMenus = categories.map(category => ({
        //             name: category.name,
        //             slug: category.slug,
        //             types: category.type
        //                 .filter(type => type.product && type.product.length > 0) // Filter jenis yang memiliki produk
        //                 .map(type => ({
        //                     name: type.name,
        //                     slug: type.slug,
        //                     image: type.product[0].image // Karena filter di atas, kita tahu setiap jenis memiliki produk
        //                 }))
        //         })).filter(category => category.types.length > 0); // Filter kategori yang memiliki jenis dengan produk
        //     } catch (error) {
        //         console.error('Error fetching categories:', error);
        //     }
        // },

        setActiveCategories(item) {
            // debugger;
            this.selectedMenu = item;
            this.activeMenu = item.name;
            this.typeMenus = item.types || [];
            this.showImage = false; 
            this.tempSelectedType = null; 
        },

        setActiveTypes(typeItem, categoryItem) {
            // debugger;
            this.tempSelectedType = typeItem; // Set the temporary selected type
            this.showImage = true; // Ensure the image is shown
            if (categoryItem) {
                // this.selectedMenu = categoryItem; // Set the selected category item
                this.selectedMenu = {
                    ...categoryItem,
                    image: typeItem.image // Asumsi bahwa 'typeItem' memiliki properti 'image'
                };
                this.activeMenu = categoryItem.name; // Keep the category highlighted
            }
            this.isMouseInType = true;
        },

        handleMouseLeaveCategory() {
            // setTimeout(() => {
                if (!this.isMouseInType) {
                    this.activeMenu = null;
                    this.selectedMenu = null;
                }
        },

        handleMouseLeaveType() {
            this.isMouseInType = true;
            this.showImage = true;
        }, 
    }));

    function getCookie(name) {
        let cookieValue = null;
        if (document.cookie && document.cookie !== '') {
            const cookies = document.cookie.split(';');
            for (let i = 0; i < cookies.length; i++) {
                const cookie = cookies[i].trim();
                if (cookie.substring(0, name.length + 1) === (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }

    Alpine.data('filterState', () => ({
        isOpenMaterial: Alpine.$persist(false),
        isOpenColor: Alpine.$persist(false),

        materialIds: Alpine.$persist([]),
        colorIds: Alpine.$persist([]),

        init() {
            const materialIdsCookie = getCookie('material_ids');
            const colorIdsCookie = getCookie('color_ids');

            this.materialIds = materialIdsCookie ? JSON.parse(materialIdsCookie) : [];
            this.colorIds = colorIdsCookie ? JSON.parse(colorIdsCookie) : [];

            this.isOpenMaterial = this.materialIds.length > 0;
            this.isOpenColor = this.colorIds.length > 0;

            // Hapus cookie setelah diproses
            
        },
        submitFilter() {
            const materialIdsString = JSON.stringify(this.materialIds);
            const colorIdsString = JSON.stringify(this.colorIds);

            document.cookie = `material_ids=${encodeURIComponent(materialIdsString)}; path=/`;
            document.cookie = `color_ids=${encodeURIComponent(colorIdsString)}; path=/`;

            window.location.href = window.Laravel.routes.filterCheckbox;
        }
    }));
    
});

Alpine.start();

// Fungsi untuk menghapus cookie
function deleteCookie(name) {
    document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

function isClickOutsideSidebar(event) {
    // Sesuaikan selektor berikut dengan elemen sidebar material dan warna Anda
    const sidebarMaterial = document.querySelector('#filter-section-0');
    const sidebarColor = document.querySelector('#filter-section-1');

    return !sidebarMaterial.contains(event.target) && !sidebarColor.contains(event.target);
}

// Event listener untuk seluruh dokumen
document.addEventListener('click', (event) => {
    if (isClickOutsideSidebar(event)) {
        // Hapus cookie ketika klik di luar sidebar
        deleteCookie('material_ids');
        deleteCookie('color_ids');
    }
});