<x-app-layout>
    <div style="background-color: #121317; min-height: 100vh; padding: 3rem 1rem; color: white;">
        <div style="max-w: 600px; margin: 0 auto; background-color: #1a1c23; padding: 2.5rem; border-radius: 1rem; border: 1px solid #2d2d2d;">
            
            <div style="display: flex; align-items: center; margin-bottom: 2rem;">
                <a href="{{ route('products.index') }}" style="color: #6b7280; margin-right: 1rem; text-decoration: none;">&larr;</a>
                <div>
                    <h2 style="font-size: 1.5rem; font-weight: 700; margin: 0;">Edit Product</h2>
                    <p style="color: #6b7280; font-size: 0.875rem;">Update details for <strong>{{ $product->name }}</strong></p>
                </div>
            </div>

            <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-size: 0.875rem; color: #9ca3af; margin-bottom: 0.5rem;">Product Name <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="name" value="{{ $product->name }}" required 
                           style="width: 100%; background-color: #24262d; border: 1px solid #374151; border-radius: 0.5rem; padding: 0.75rem; color: white;">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 2rem;">
                    <div>
                        <label style="display: block; font-size: 0.875rem; color: #9ca3af; margin-bottom: 0.5rem;">Quantity <span style="color: #ef4444;">*</span></label>
                        <input type="number" name="quantity" value="{{ $product->quantity }}" required
                               style="width: 100%; background-color: #24262d; border: 1px solid #374151; border-radius: 0.5rem; padding: 0.75rem; color: white;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.875rem; color: #9ca3af; margin-bottom: 0.5rem;">Price (Rp) <span style="color: #ef4444;">*</span></label>
                        <input type="number" name="price" value="{{ $product->price }}" required
                               style="width: 100%; background-color: #24262d; border: 1px solid #374151; border-radius: 0.5rem; padding: 0.75rem; color: white;">
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <button type="button" onclick="document.getElementById('delete-form').submit();" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.875rem; display: flex; align-items: center;">
                        <svg style="width: 1rem; height: 1rem; margin-right: 0.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Delete Product
                    </button>
                    <div style="display: flex; gap: 1rem;">
                        <a href="{{ route('products.index') }}" style="background-color: #24262d; color: white; padding: 0.625rem 1.25rem; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; border: 1px solid #374151;">Cancel</a>
                        <button type="submit" style="background-color: #6366f1; color: white; padding: 0.625rem 1.25rem; border-radius: 0.5rem; border: none; font-weight: 600;">Update Product</button>
                    </div>
                </div>
            </form>

            <form id="delete-form" action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: none;">
                @csrf @method('DELETE')
            </form>
        </div>
    </div>
</x-app-layout>