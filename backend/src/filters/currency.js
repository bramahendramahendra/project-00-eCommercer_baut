export default function currencyIDR(value) {
    return new Intl.NumberFormat('ID', { style: 'currency', currency: 'IDR' }).format(value);
}