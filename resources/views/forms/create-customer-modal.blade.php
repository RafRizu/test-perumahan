<!-- Modal Tambah Customer -->
<div class="modal fade" id="createCustomerModal" tabindex="-1" aria-labelledby="createCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <form action="{{ route('customers.store') }}" method="POST">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title">Tambah Customer</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <!-- Info Unit -->
            <input type="hidden" name="unit_id" id="create_unit_id">
            <input type="hidden" name="unit_group_id" id="create_unit_group_id">

            <div class="row">
              <div class="col-md-6 mb-2">
                <label>Unit Group</label>
                <input type="text" class="form-control" id="create_unit_group_name" disabled>
              </div>
              <div class="col-md-6 mb-2">
                <label>Unit</label>
                <input type="text" class="form-control" id="create_unit_name" disabled>
              </div>
            </div>

            <!-- Form Input -->
            <div class="row">
              <div class="col-md-6 mb-2">
                <label>Nama Customer</label>
                <input type="text" name="name" class="form-control" required>
              </div>
              <div class="col-md-6 mb-2">
                <label>Nomor KTP</label>
                <input type="text" name="national_id" class="form-control" required maxlength="16">
              </div>
              <div class="col-md-6 mb-2">
                <label>Nama Pasangan</label>
                <input type="text" name="partner_name" class="form-control">
              </div>
              <div class="col-md-6 mb-2">
                <label>Nomor KTP Pasangan</label>
                <input type="text" name="partner_national_id" class="form-control" maxlength="16">
              </div>
              <div class="col-md-6 mb-2">
                <label>Tanggal Lahir</label>
                <input type="date" name="birth_date" class="form-control" required>
              </div>

              <div class="col-md-6 mb-2">
                <label>Tanggal Lahir Pasangan</label>
                <input type="date" name="partner_birth_date" class="form-control">
              </div>
              <input type="hidden" name="status" value="ordered">
              <div class="col-md-6 mb-2">
                <label>Status Pembayaran</label>
                <select name="payment_status" id="create_payment_status" class="form-control" required>
                  <option value="">Pilih</option>
                  <option value="reject">Reject</option>
                  <option value="qualify">Qualify</option>
                </select>
              </div>
              <div class="col-md-6 mb-2">
                <label>Solusi (jika reject)</label>
                <select name="solution" id="create_solution" class="form-control" disabled>
                  <option value="">Pilih Solusi</option>
                  <option value="Takeover Bank">Takeover Bank</option>
                  <option value="Clearing Payment">Clearing Payment</option>
                  <option value="Change Credit Name">Change Credit Name</option>
                  <option value="Repayment">Repayment</option>
                </select>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
