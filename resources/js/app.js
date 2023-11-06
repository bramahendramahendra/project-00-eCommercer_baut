import './bootstrap';

import Alpine from 'alpinejs';
import persist from '@alpinejs/persist'
import collapse from '@alpinejs/collapse'

Alpine.plugin(persist)
Alpine.plugin(collapse)

window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.store("header", {
        cartItemsObject: Alpine.$persist({}),
        get cartItems() {
            return Object.values(this.cartItemsObject)
                .reduce((accum, next) => accum + parseInt(next.quantity), 0)
        },
    });

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
            id: product.id,
            product,
            quantity: 1,
            addToCart(id, quantity = 1) {
                this.$store.header.cartItemsObject[id] = this.$store.header.cartItemsObject[id] || { ...product, quantity: 0 };
                this.$store.header.cartItemsObject[id].quantity = parseInt(this.$store.header.cartItemsObject[id].quantity) + parseInt(quantity);
                this.$dispatch('notify', {
                    message: "Produk anda ditambahkan ke keranjang"
                })
            },
            removeItemFromCart() {
                delete this.$store.header.cartItemsObject[this.id]
                this.$dispatch('notify', {
                    message: "Produk anda dihapus dari keranjang"
                })
            }
        }
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
});


Alpine.start();