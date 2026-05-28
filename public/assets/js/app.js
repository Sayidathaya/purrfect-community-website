function confirmDelete(event, form) {
  event.preventDefault();
  Swal.fire({
    title: 'Yakin hapus?',
    text: 'Data yang dihapus tidak bisa dikembalikan.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya, hapus',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      form.submit();
    }
  });
  return false;
}
