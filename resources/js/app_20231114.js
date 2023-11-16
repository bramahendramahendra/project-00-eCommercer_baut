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
        clothingMenu: [
            { name: 'Tops' },
            { name: 'Dresses' }
        ],
        accessoriesMenu: [],
        activeMenu: null,
        selectedMenu: null,
        showImage: false,
        tempSelectedAccessory: null, // Menyimpan sementara accessory terpilih


        init() {
            // Initialization code here
            this.accessoriesMenu = this.getRelatedAccessories('Tops'); // Set default accessories menu
        },
        setActiveClothing(item) {
            this.selectedMenu = item;
            this.activeMenu = item.name;
            this.accessoriesMenu = this.getRelatedAccessories(item.name);
            this.showImage = false; // Pastikan gambar tidak ditampilkan ketika clothing diklik
            this.tempSelectedAccessory = null; // Reset accessory terpilih
        },

        setActiveAccessory(item) {
            this.selectedMenu = item; // Set the selected menu item to the clicked accessory
            this.tempSelectedAccessory = item; // Set the temporary selected accessory
            this.showImage = true; // Ensure the image is shown
        },

        getRelatedAccessories(clothingName) {
            // Tentukan accessories terkait di sini berdasarkan logika bisnis Anda
            const relatedAccessories = {
                'Tops': [
                    { name: 'Watches', image: 'https://tailwindui.com/img/ecommerce-images/mega-menu-category-01.jpg' },
                    { name: 'Wallets', image: 'https://tailwindui.com/img/ecommerce-images/mega-menu-category-02.jpg' }
                ],
                'Dresses': [
                    { name: 'Belts', image: 'https://tailwindui.com/img/ecommerce-images/mega-menu-category-03.jpg' },
                    { name: 'Hats', image: 'https://tailwindui.com/img/ecommerce-images/mega-menu-category-04.jpg' }
                ]
            };
            return relatedAccessories[clothingName] || [];
        },

        // Menambahkan fungsi untuk menangani mouse leave event pada menu accessories
        handleMouseLeave() {
            if (this.tempSelectedAccessory) {
                this.selectedMenu = this.tempSelectedAccessory;
                this.showImage = true;
            }
        }
    }));

    Alpine.data('filterState', () => ({
        isOpen: Alpine.$persist(false),
        materialIds: Alpine.$persist([]),
        init() {
            // Membaca parameter URL dan memperbarui materialIds
            const params = new URLSearchParams(window.location.search);
            this.materialIds = params.getAll('material_id[]').map((id) => parseInt(id));
            // Jika ada material yang dipilih, buka sidebar
            this.isOpen = this.materialIds.length > 0;
        },
        submitFilter() {
            const params = new URLSearchParams();

            // Update parameter query dengan ID material yang dipilih
            this.materialIds.forEach((id) => {
                params.append('material_id[]', id);
            });

            // Redirect ke halaman katalog dengan parameter query yang baru
            // window.location.href = "{{ route('katalog') }}" + "?" + params.toString();
            window.location.href = window.Laravel.routes.katalog + "?" + params.toString();
        }
    }));
});


Alpine.start();