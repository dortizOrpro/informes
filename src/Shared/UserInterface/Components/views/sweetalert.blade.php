<script>
    window.addEventListener('swal', event => {
        console.log( 'Sweetalert blade', event.detail );
        window.swal.fire({
            title: event.detail[0].title,
            text: event.detail[0].text,
            icon: event.detail[0].icon,
            // Add more SweetAlert2 options as needed from event.detail
        });
    });

    // For confirmation alerts (e.g., delete confirmation)
    window.addEventListener('swal:confirm', event => {
        window.swal.fire({
            title: event.detail.title,
            text: event.detail.text,
            icon: event.detail.type,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#aaa',
            confirmButtonText: event.detail.confirmButtonText
        }).then((result) => {
            if (result.isConfirmed) {
                // Call a Livewire method to perform the action (e.g., delete)
                Livewire.dispatch(event.detail.action, event.detail.params);
            }
        });
    });
</script>
