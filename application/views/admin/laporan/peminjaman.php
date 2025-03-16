<div class="row">
    <div id="flash" data-flash="<?= $this->session->flashdata('msg') ?>" data-class="<?= $this->session->flashdata('class') ?>"></div>
    <div class="col-lg-6">
        <form id="frm-filter-pinjam">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <input type="date" name="start_date" id="start_date" required class="form-control">
                    </div>
                </div>
                <label for="start_date" class="col-lg-1 d-flex align-items-center justify-content-center" style="height: 34px;">s/d</label>
                <div class="col-lg-3">
                    <div class="form-group">
                        <input type="date" id="end_date" name="end_date" class="form-control">
                    </div>
                </div>
                <div class="col-lg-2">
                    <button type="submit" class="btn btn-info">FILTER</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-12">

        <div class="box box-solid new-shadow">
            <div class="box-body table-responsive">
                <table class="table" id="peminjaman">
                    <thead>
                        <tr>
                            <th>Anggota</th>
                            <th>Buku</th>
                            <th>Tgl Pinjam</th>
                            <th>Tenggat</th>
                            <th>Jumlah Pinjam</th>
                            <th>Jenis Pinjam</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>




</div>