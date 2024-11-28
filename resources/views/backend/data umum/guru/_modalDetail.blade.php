<!-- Modal untuk Menampilkan Data Guru -->
<div class="modal fade" id="modalView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modalTitle" id="staticBackdropLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="viewName" class="form-label">Nama</label>
                    <input type="text" id="viewName" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label for="viewNip" class="form-label">NIP</label>
                    <input type="text" id="viewNip" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label for="viewAddress" class="form-label">Alamat</label>
                    <textarea id="viewAddress" class="form-control" rows="3" readonly></textarea>
                </div>
                <div class="mb-3">
                    <label for="viewPhone" class="form-label">Nomor Kontak</label>
                    <input type="text" id="viewPhone" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label for="viewEmail" class="form-label">Email</label>
                    <input type="text" id="viewEmail" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label for="viewImage" class="form-label">Pas Foto</label>
                    <div id="viewImageContainer">
                        <!-- Tempat untuk menampilkan gambar -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>