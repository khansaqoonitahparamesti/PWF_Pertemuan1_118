<x-app-layout>
    <div style="background-color: #121317; min-height: 100vh; padding: 3rem 1rem; color: white;">
        <div style="max-w: 600px; margin: 0 auto; background-color: #1a1c23; border-radius: 1rem; border: 1px solid #2d2d2d; overflow: hidden; shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);">
            
            {{-- Header Detail --}}
            <div style="padding: 1.5rem 2rem; border-bottom: 1px solid #2d2d2d; display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center;">
                    <a href="{{ route('products.index') }}" style="color: #6b7280; margin-right: 1rem; text-decoration: none; font-size: 1.25rem;">&larr;</a>
                    <div>
                        <h2 style="font-size: 1.25rem; font-weight: 700; margin: 0;">Product Detail</h2>
                        <p style="color: #6b7280; font-size: 0.75rem; margin: 0;">Viewing product #{{ $product->id }}</p>
                    </div>
                </div>

                {{-- Action Buttons (Hapus @can supaya selalu muncul) --}}
                <div style="display: flex; gap: 0.5rem;">
                    <a href="{{ route('products.edit', $product->id) }}" 
                       style="border: 1px solid #d97706; color: #fbbf24; padding: 0.5rem 1rem; border-radius: 0.5rem; font-size: 0.75rem; text-decoration: none; font-weight: 600; transition: 0.2s;"
                       onmouseover="this.style.backgroundColor='rgba(217, 119, 6, 0.1)'"
                       onmouseout="this.style.backgroundColor='transparent'">
                       Edit
                    </a>
                    
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" 
                                style="border: 1px solid #dc2626; color: #ef4444; background: none; padding: 0.5rem 1rem; border-radius: 0.5rem; font-size: 0.75rem; cursor: pointer; font-weight: 600; transition: 0.2s;"
                                onmouseover="this.style.backgroundColor='rgba(220, 38, 38, 0.1)'"
                                onmouseout="this.style.backgroundColor='transparent'">
                                Delete
                        </button>
                    </form>
                </div>
            </div>

            {{-- Content Detail --}}
            <div style="padding: 1rem 2rem;">
                <div style="display: flex; padding: 1.25rem 0; border-bottom: 1px solid #24262d;">
                    <span style="width: 140px; color: #9ca3af; font-size: 0.875rem;">Product Name</span>
                    <span style="font-weight: 600; color: #f3f4f6;">{{ $product->name }}</span>
                </div>

                <div style="display: flex; padding: 1.25rem 0; border-bottom: 1px solid #24262d;">
                    <span style="width: 140px; color: #9ca3af; font-size: 0.875rem;">Quantity</span>
                    <span style="color: {{ $product->qty < 10 ? '#ef4444' : '#10b981' }}; font-weight: 700;">
                        {{ $product->qty }} {{ $product->qty < 10 ? '(Low Stock)' : '' }}
                    </span>
                </div>

                <div style="display: flex; padding: 1.25rem 0; border-bottom: 1px solid #24262d;">
                    <span style="width: 140px; color: #9ca3af; font-size: 0.875rem;">Price</span>
                    <span style="color: #e5e7eb; font-family: monospace; font-size: 1rem;">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                </div>

                <div style="display: flex; padding: 1.25rem 0; border-bottom: 1px solid #24262d; align-items: center;">
                    <span style="width: 140px; color: #9ca3af; font-size: 0.875rem;">Owner</span>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 1.75rem; height: 1.75rem; background-color: #6366f1; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 700;">
                            {{ strtoupper(substr($product->user->name ?? 'U', 0, 1)) }}
                        </div>
                        <span style="color: #d1d5db;">{{ $product->user->name ?? 'Unknown' }}</span>
                    </div>
                </div>

                <div style="display: flex; padding: 1.25rem 0; border-bottom: 1px solid #24262d;">
                    <span style="width: 140px; color: #9ca3af; font-size: 0.875rem;">Created At</span>
                    <span style="color: #6b7280;">{{ $product->created_at->format('d M Y, H:i') }}</span>
                </div>

                <div style="display: flex; padding: 1.25rem 0;">
                    <span style="width: 140px; color: #9ca3af; font-size: 0.875rem;">Updated At</span>
                    <span style="color: #6b7280;">{{ $product->updated_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>