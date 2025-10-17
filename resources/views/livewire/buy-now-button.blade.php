<div>
    <button wire:click="buyNow" wire:loading.attr="disabled" class="btn btn-block border-0 w-100 p-2 btn-gradient">
        <span wire:loading.remove>
            <i class="fas fa-shopping-basket"></i> Buy Now
        </span>
        <span wire:loading>
            <i class="fas fa-spinner fa-spin"></i> Adding...
        </span>
    </button>
    
    @script
    <script>
        Livewire.on('error', (message) => {
            Swal.fire({
                title: 'Error!',
                text: message,
                icon: 'error',
                timer: 3000,
                showConfirmButton: false,
            });
        });
    </script>
    @endscript
</div>