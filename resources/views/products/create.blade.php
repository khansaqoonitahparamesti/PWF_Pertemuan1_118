<x-app-layout>
    <div style="background-color: #121317; min-height: 100vh; padding: 3rem 1rem; color: white;">
        <div style="max-width: 600px; margin: 0 auto; background-color: #1a1c23; padding: 2.5rem; border-radius: 1rem; border: 1px solid #2d2d2d; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.5);">
            
            <div style="display: flex; align-items: center; margin-bottom: 2rem;">
                <a href="{{ route('products.index') }}" style="color: #6b7280; margin-right: 1rem; text-decoration: none;">&larr;</a>
                <div>
                    <h2 style="font-size: 1.5rem; font-weight: 700; margin: 0;">Add Product</h2>
                    <p style="color: #6b7280; font-size: 0.875rem;">Fill in the details to add a new product</p>
                </div>
            </div>

            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                
            <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-size: 0.875rem; color: #9ca3af; margin-bottom: 0.5rem;">Nama Produk <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Wireless Headphones" 
                           style="width: 100%; background-color: #24262d; border: 1px solid {{ $errors->has('name') ? '#ef4444' : '#374151' }}; border-radius: 0.5rem; padding: 0.75rem; color: white; outline: none;">
                    @error('name')
                        <small style="color: #ef4444; display: block; margin-top: 0.25rem;">{{ $message }}</small>
                    @enderror
                </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 2rem;">
                <div>
                    <label style="display: block; font-size: 0.875rem; color: #9ca3af; margin-bottom: 0.5rem;">Quantity <span style="color: #ef4444;">*</span></label>
                    <input type="number" name="qty" value="{{ old('qty', 0) }}"
                        style="width: 100%; background-color: #24262d; border: 1px solid {{ $errors->has('qty') ? '#ef4444' : '#374151' }}; border-radius: 0.5rem; padding: 0.75rem; color: white; outline: none;">
                    @error('qty')
                        <small style="color: #ef4444; display: block; margin-top: 0.25rem;">{{ $message }}</small>
                    @enderror
            </div>
            <div>
                    <label style="display: block; font-size: 0.875rem; color: #9ca3af; margin-bottom: 0.5rem;">Price (Rp) <span style="color: #ef4444;">*</span></label>
                    <input type="number" name="price" value="{{ old('price', 0) }}"
                        style="width: 100%; background-color: #24262d; border: 1px solid {{ $errors->has('price') ? '#ef4444' : '#374151' }}; border-radius: 0.5rem; padding: 0.75rem; color: white; outline: none;">
                    @error('price')
                        <small style="color: #ef4444; display: block; margin-top: 0.25rem;">{{ $message }}</small>
                    @enderror
            </div>
                </div>


                <div style="display: flex; justify-content: flex-end; gap: 1rem;">
                    <a href="{{ route('products.index') }}" style="background-color: #24262d; color: white; padding: 0.625rem 1.25rem; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; border: 1px solid #374151;">Cancel</a>
                    <button type="submit" style="background-color: #6366f1; color: white; padding: 0.625rem 1.25rem; border-radius: 0.5rem; border: none; font-weight: 600; cursor: pointer;">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>