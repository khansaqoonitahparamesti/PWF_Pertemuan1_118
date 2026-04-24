<x-app-layout>
    {{-- Container Utama --}}
    <div style="background-color: #121317; min-height: 100vh; padding: 3rem 2rem; color: #d1d5db; font-family: sans-serif;">
        
        <div style="max-width: 1280px; margin: 0 auto;">
            
            {{-- NOTIFIKASI SUKSES --}}
            @if(session('success'))
                <div style="background-color: rgba(6, 95, 70, 0.2); color: #34d399; padding: 1rem; border-radius: 0.75rem; border: 1px solid rgba(5, 150, 105, 0.3); margin-bottom: 1.5rem; display: flex; align-items: center; animation: fadeIn 0.5s;">
                    <svg style="width: 1.25rem; height: 1.25rem; margin-right: 0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span style="font-weight: 500;">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Card Utama --}}
            <div style="background-color: #1a1c23; border-radius: 1rem; border: 1px solid #2d2d2d; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);">
                
                {{-- Bagian Header --}}
                <div style="padding: 2.5rem; display: flex; justify-content: space-between; align-items: center;">
                    <!-- <div>
                        <h1 style="color: white; font-size: 2rem; font-weight: 800; margin: 0;">Product List</h1>
                        <p style="color: #6b7280; font-size: 0.95rem; margin-top: 0.5rem;">Manage your product inventory</p>
                    </div> -->
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 tracking-tight">Product List</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage your product inventory</p>
                        </div>
                        @can('manage-products')
                            <x-add-product :url="route('product.create')" :name="'Product'"/>
                        @endcan
                    </div>
                    
                    {{-- Tombol Add Product --}}
                    <a href="{{ route('products.create') }}" 
                       style="background-color: #6366f1; color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-size: 0.875rem; font-weight: 700; text-decoration: none; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 14px 0 rgba(99, 102, 241, 0.39);">
                        <span style="font-size: 1.25rem;">+</span> Add Product
                    </a>
                </div>

                {{-- Tabel --}}
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left;">
                        <thead style="background-color: rgba(255,255,255,0.02); border-bottom: 1px solid #2d2d2d;">
                            <tr style="color: #6b7280; font-size: 12px; text-transform: uppercase; letter-spacing: 0.1em; font-weight: 700;">
                                <th style="padding: 1.25rem 2.5rem;">#</th>
                                <th style="padding: 1.25rem 1.5rem;">Name</th>
                                <th style="padding: 1.25rem 1.5rem;">Quantity</th>
                                <th style="padding: 1.25rem 1.5rem;">Price</th>
                                <th style="padding: 1.25rem 1.5rem;">Owner</th>
                                <th style="padding: 1.25rem 2.5rem; text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        
                        <tbody style="font-size: 0.9rem; color: #e5e7eb;">
                            @forelse($products as $index => $product)
                            <tr style="border-bottom: 1px solid #2d2d2d; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='rgba(255,255,255,0.01)'" onmouseout="this.style.backgroundColor='transparent'">
                                <td style="padding: 1.5rem 2.5rem; color: #4b5563;">{{ $index + 1 }}</td>
                                <td style="padding: 1.5rem 1.5rem; font-weight: 500;">{{ $product->name }}</td>
                                
                                <td style="padding: 1.5rem 1.5rem;">
                                    @if($product->qty < 10)
                                        <span style="background-color: rgba(239, 68, 68, 0.15); color: #ef4444; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 11px; font-weight: 800; border: 1px solid rgba(239, 68, 68, 0.2);">
                                            {{ $product->qty }}
                                        </span>
                                    @else
                                        <span style="background-color: rgba(16, 185, 129, 0.15); color: #10b981; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 11px; font-weight: 800; border: 1px solid rgba(16, 185, 129, 0.2);">
                                            {{ $product->qty }}
                                        </span>
                                    @endif
                                </td>
                                
                                <td style="padding: 1.5rem 1.5rem;">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td style="padding: 1.5rem 1.5rem; color: #9ca3af;">{{ $product->user->name ?? 'Unknown' }}</td>
                                
                                <td style="padding: 1.5rem 2.5rem;">
                                    <div style="display: flex; justify-content: center; align-items: center; gap: 1.25rem; color: #6b7280;">
                                        <a href="{{ route('products.show', $product->id) }}" style="color: inherit; transition: color 0.2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='#6b7280'">
                                            <svg style="width: 1.4rem; height: 1.4rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>

                                        <a href="{{ route('products.edit', $product->id) }}" style="color: inherit; transition: color 0.2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='#6b7280'">
                                            <svg style="width: 1.3rem; height: 1.3rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>

                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Hapus produk?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" style="background: none; border: none; padding: 0; color: inherit; cursor: pointer; transition: color 0.2s;" onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='#6b7280'">
                                                <svg style="width: 1.3rem; height: 1.3rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" style="padding: 5rem; text-align: center; color: #4b5563; font-style: italic;">
                                    Belum ada data produk.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>