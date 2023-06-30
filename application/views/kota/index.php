<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header neu-brutalism-border">
            <h1><?= $title; ?></h1>
        </div>

        <?= $this->session->flashdata('message') ?>
        <?= form_error('menu', '<div class="alert alert-danger neu-brutalism mb-4">', '</div>') ?>

        <a href="#" data-toggle="modal" data-target="#modalMenuBaru" class="btn btn-icon icon-left btn-primary mb-4 neu-brutalism"><i class="fas fa-plus"></i> Tambah Kota Baru</a>

        <div class="table-responsive rounded">
            <table class="table table-hover table-bordered neu-brutalism-border display" id="myTable">
                <thead>
                    <tr>
                        <th scope="col" class="text-dark">#</th>
                        <th scope="col" class="text-dark">Kota</th>
                        <th scope="col" class="text-dark">Harga</th>
                        <th scope="col" class="text-dark">Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($kota as $k) : ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $k['kota'] ?></td>
                            <td><?= $k['harga'] ?></td>
                            <td>
                                <a href="#" onclick="ubah('<?= $k['id'] ?>')" class="btn btn-warning mr-2 neu-brutalism"><i class="fas fa-edit"></i> Ubah</a>
                                <a class="btn btn-danger neu-brutalism hapus" data-id="<?= $k['id'] ?>" data-url="<?= base_url('kota/hapus') ?>" data-kota="<?= $k['kota'] ?>"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
</div>
</section>
</div>

<!-- Modal -->
<div class="modal fade" id="modalMenuBaru" tabindex="-1" role="dialog" aria-labelledby="modalMenuBaruLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content neu-brutalism-border">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="newModalMenuBaru">Tambah Kota Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('kota') ?>" method="POST">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="kota" class="form-label">Nama kota</label>
                        <input type="text" class="form-control" id="kota" name="kota">
                    </div>
                    <div class="form-group">
                        <label for="harga" class="form-label">Nama harga</label>
                        <input type="text" class="form-control" id="harga" name="harga">
                    </div>
                </div>
                


                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary neu-brutalism" id="submit"><i class="fas fa-plus"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalMenuUbah" tabindex="-1" role="dialog" aria-labelledby="modalMenuUbahLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content neu-brutalism-border">
            <div class="modal-header">
                <h5 class="modal-title modal-ubah text-dark" id="newModalMenuUbah">Ubah Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <?= form_open_multipart('kota/ubah'); ?>
                <input type="hidden" class="form-control" id="idUbah" name="id">


                <div class="modal-body">
                    <div class="form-group">
                        <label for="kota" class="form-label">Nama kota</label>
                        <input type="text" class="form-control" id="kotaubah" name="kotaubah">
                    </div>
                    <div class="form-group">
                        <label for="harga" class="form-label">Nama harga</label>
                        <input type="text" class="form-control" id="hargaubah" name="hargaubah">
                    </div>

                    <div class="form-group row">
                                <div class="col-sm-4">Gambar</div>
                                <div class="col-sm-11">
                                    <img src="" class="img-thumbnail img-preview">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input gambar-preview" id="image" name="image" onchange="previewImage()">
                                        <label for="image" class="custom-file-label">Pilih File</label>
                                    </div>
                                </div>
                            </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning neu-brutalism" id="submit"><i class="fas fa-edit"></i> Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const baseUrl = `<?= base_url() ?>`

    const ubah = (id) => {
        $.get(`${baseUrl}kota/get_kota/${id}`, (data) => {
            const kota = $.parseJSON(data)

            $('.modal-ubah').text('Ubah Menu')
            $('#idUbah').val(kota.id);
            $('#kotaubah').val(kota.kota);
            $('#hargaubah').val(kota.harga);
            $('.img-preview').attr('src', `${baseUrl}/assets/img/destinasi/${kota.image}`)
            $('#modalMenuUbah').modal('show');
        })
    }

    const hapusMenu = document.querySelectorAll('.hapus')
    hapusMenu.forEach((hm) => {
        hm.addEventListener('click', () => {
            const dataId = hm.dataset.id
            const dataUrl = hm.dataset.url
            const datakota = hm.dataset.kota
            Swal.fire({
                icon: 'warning',
                html: `Apakah anda yakin ingin menghapus Menu <b>${datakota}</b>?`,
                showCancelButton: true,
                confirmButtonColor: '#d9534f',
                cancelButtonColor: '#5cb85c',
                confirmButtonText: `Ya`,
                cancelButtonText: `Tidak`,
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = `${dataUrl}/${dataId}`
                }
            })
        })
    })
</script>