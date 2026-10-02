@extends('layouts.app')

@section('content')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div x-data="ticketCart()" class="flex flex-col lg:flex-row gap-8">
    <!-- Left Column: Tickets List -->
    <div class="lg:w-2/3">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Pilih Tiket Konser</h1>
            <a href="{{ route('concerts.create') }}" class="bg-indigo-600 text-white px-5 py-2.5 rounded-full font-semibold shadow hover:bg-indigo-700 transition duration-200 text-sm">
                + Tambah Konser Baru
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse ($concerts as $concert)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-200 flex flex-col">
                    <div class="p-6 flex-grow">
                        <div class="flex justify-between items-start mb-4">
                            <h2 class="text-xl font-bold text-gray-800">{{ $concert->name }}</h2>
                            <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Rp {{ number_format($concert->price, 0, ',', '.') }}</span>
                        </div>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $concert->description ?? 'Tidak ada deskripsi.' }}</p>
                        
                        <div class="text-sm text-gray-600 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ $concert->date->format('d M Y, H:i') }}
                        </div>
                        <div class="text-sm text-gray-600 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $concert->venue }}
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t border-gray-100">
                        <a href="{{ route('concerts.edit', $concert) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Edit Info</a>
                        <button 
                            @click="addToCart({{ $concert->id }}, '{{ addslashes($concert->name) }}', {{ $concert->price }})"
                            class="bg-gray-900 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow hover:bg-gray-800 transition duration-200">
                            Beli Tiket
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 bg-white rounded-2xl border border-gray-100">
                    <p class="text-gray-500 mb-4">Belum ada konser yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Right Column: Cart -->
    <div class="lg:w-1/3">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 sticky top-6">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Keranjang Tiket
                </h2>
            </div>
            
            <div class="p-6 flex flex-col h-[400px]">
                <div class="flex-grow overflow-y-auto">
                    <template x-if="cart.length === 0">
                        <div class="text-center text-gray-400 mt-10">
                            Keranjang masih kosong.<br>Pilih tiket di sebelah kiri.
                        </div>
                    </template>
                    
                    <template x-for="item in cart" :key="item.id">
                        <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-50 last:border-0 last:pb-0">
                            <div>
                                <h3 class="font-semibold text-gray-800 text-sm" x-text="item.name"></h3>
                                <p class="text-xs text-gray-500">Rp <span x-text="formatRupiah(item.price)"></span></p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center border border-gray-200 rounded-lg">
                                    <button @click="decreaseQuantity(item.id)" class="px-2 py-1 text-gray-600 hover:bg-gray-100 rounded-l-lg">-</button>
                                    <span class="px-2 py-1 text-sm font-medium w-8 text-center" x-text="item.quantity"></span>
                                    <button @click="increaseQuantity(item.id)" class="px-2 py-1 text-gray-600 hover:bg-gray-100 rounded-r-lg">+</button>
                                </div>
                                <button @click="removeFromCart(item.id)" class="text-red-500 hover:text-red-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
                
                <div class="pt-4 border-t border-gray-100 mt-4">
                    <div class="flex justify-between items-center mb-4">
                        <span class="font-bold text-gray-700">Total</span>
                        <span class="font-bold text-xl text-indigo-600">Rp <span x-text="formatRupiah(totalPrice)"></span></span>
                    </div>
                    <button class="w-full bg-indigo-600 text-white py-3 rounded-xl font-bold shadow hover:bg-indigo-700 transition duration-200 flex justify-center items-center" :disabled="cart.length === 0" :class="{'opacity-50 cursor-not-allowed': cart.length === 0}">
                        Checkout Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('ticketCart', () => ({
            cart: [],
            
            get totalPrice() {
                return this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
            },
            
            addToCart(id, name, price) {
                const existingItem = this.cart.find(item => item.id === id);
                if (existingItem) {
                    existingItem.quantity++;
                } else {
                    this.cart.push({ id, name, price, quantity: 1 });
                }
            },
            
            increaseQuantity(id) {
                const item = this.cart.find(item => item.id === id);
                if (item) item.quantity++;
            },
            
            decreaseQuantity(id) {
                const item = this.cart.find(item => item.id === id);
                if (item) {
                    if (item.quantity > 1) {
                        item.quantity--;
                    } else {
                        this.removeFromCart(id);
                    }
                }
            },
            
            removeFromCart(id) {
                this.cart = this.cart.filter(item => item.id !== id);
            },
            
            formatRupiah(number) {
                return new Intl.NumberFormat('id-ID').format(number);
            }
        }))
    })
</script>
@endsection
