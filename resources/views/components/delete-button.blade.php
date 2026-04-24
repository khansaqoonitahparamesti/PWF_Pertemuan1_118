<div>
    <form action="{{ $url }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
            Hapus
        </button>
    </form>
</div>