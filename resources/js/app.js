import './bootstrap';
import Alpine from 'alpinejs';

Alpine.store('cart', {
    items: JSON.parse(localStorage.getItem('ngombee_cart') || '[]'),
    userLoggedIn: window.Laravel?.userLoggedIn || false,

    save() {
        localStorage.setItem('ngombee_cart', JSON.stringify(this.items));
    },

    getItemQty(id) {
        const item = this.items.find(i => i.id === id);
        return item ? item.qty : 0;
    },

    addToCart(id, name, price) {
        if (!this.userLoggedIn) {
            window.location.href = window.Laravel.routeLogin;
            return;
        }

        const item = this.items.find(i => i.id === id);
        if (item) {
            item.qty++;
        } else {
            this.items.push({ id, name, price, qty: 1 });
        }
        this.save();
        // ✅ TIDAK PERLU notify() karena pakai $watch
    },

    removeFromCart(id) {
        if (!this.userLoggedIn) return;

        const index = this.items.findIndex(i => i.id === id);
        if (index > -1) {
            if (this.items[index].qty > 1) {
                this.items[index].qty--;
            } else {
                this.items.splice(index, 1);
            }
            this.save();
        }
    },

    getTotalItems() {
        return this.items.reduce((sum, item) => sum + item.qty, 0);
    },

    getTotalPrice() {
        return this.items.reduce((sum, item) => sum + (item.price * item.qty), 0);
    }
});

window.Alpine = Alpine;
Alpine.start();
