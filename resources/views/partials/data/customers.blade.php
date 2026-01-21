<div class="card shadow mb-4">
    <div class="card-header font-weight-bold text-primary">Data Customer</div>
    <div class="card-body p-3 table-responsive">
        <table class="table table-bordered table-hover mb-0" id="customerTable">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Unit</th>
                    <th>Unit Group</th>
                    <th>Status</th>
                    <th>Approval Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($customers as $c)
                    <tr class="">
                        <td>{{ $no++ }}</td>
                        <td>{{ $c->name }}</td>
                        <td>{{ $c->unit->name }}</td>
                        <td>{{ $c->unit->unitGroup->name }}</td>
                        <td>
                            <span @class([
                                'text-uppercase',
                                'badge',
                                'badge-warning' => $c->status == 'ordered',
                                'badge-success' => $c->status == 'booked',
                                'badge-info' => $c->status == 'dp',
                            ])>
                                {{ $c->status }}
                            </span>
                        </td>
                        <td class="text-center">
                            <span @class([
                                'text-uppercase',
                                'badge',
                                'badge-success' => $c->approval_status == 'approved',
                                'badge-secondary' => $c->approval_status == 'pending',
                                'badge-danger' => $c->approval_status == 'rejected',
                            ])>
                                {{ $c->approval_status }}
                            </span>
                        </td>
                        <td class="d-flex justify-content-center text-nowrap" style="gap: .75rem;">
                            <button class="btn btn-info btn-sm btn-detail" data-toggle="modal"
                                data-target="#detailCustomerModal" data-name="{{ $c->name }}"
                                data-partnername="{{ $c->partner_name }}" data-nik="{{ $c->national_id }}"
                                data-partnernik="{{ $c->partner_national_id }}"
                                data-old="{{ $c->birth_date ? \Carbon\Carbon::parse($c->birth_date)->age : '-' }} Tahun"
                                data-partnerold="{{ $c->partner_birth_date ? \Carbon\Carbon::parse($c->partner_birth_date)->age : '-' }} Tahun"
                                data-unitgroup="{{ $c->unit->unitGroup->name }}" data-unit="{{ $c->unit->name }}"
                                data-edit-url="{{ route('customers.edit', ['id' => $c->id]) }}"
                                data-delete-url="{{ route('customers.destroy', ['id' => $c->id]) }}">
                                <i class="fas fa-search"></i> Detail
                            </button>

                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-exchange"></i> Change
                                </button>
                                <div class="dropdown-menu dropdown-menu-right text-uppercase">
                                    <form action="{{ route('customers.change.booking', $c->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="dropdown-item"
                                            style="width:100%;text-align:left;">booked</button>
                                    </form>
                                    <form action="{{ route('customers.change.dp', $c->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="dropdown-item"
                                            style="width:100%;text-align:left;">dp</button>
                                    </form>
                                </div>
                            </div>
                            {{-- sementara disabled --}}
                            {{-- <a class="dropdown-item" href="#">akad</a> --}}

                            @if ($user->role == 'superadmin')
                                @if ($c->approval_status == 'approved')
                                    <button type="button" class="btn btn-secondary btn-sm"
                                        style="pointer-events: none;"><i class="fas fa-check"></i> Approval</button>
                                @else
                                    <form action="{{ route('customers.approve', $c->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm"><i
                                                class="fas fa-check"></i> Approval</button>
                                    </form>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- End of PageContent -->

<!-- Modal Detail Customer -->
<div class="modal fade" id="detailCustomerModal" tabindex="-1" role="dialog"
    aria-labelledby="detailCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="detailCustomerModalLabel">Detail Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!-- Info Unit -->
                <input type="hidden" name="unit_id" id="detail_unit_id">
                <input type="hidden" name="unit_group_id" id="detail_unit_group_id">

                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Unit Group</label>
                        <input type="text" class="form-control" id="detail_unit_group_name" disabled>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Unit</label>
                        <input type="text" class="form-control" id="detail_unit_name" disabled>
                    </div>
                </div>

                <!-- Form Input -->
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Nama Customer</label>
                        <input type="text" name="name" class="form-control" id="detail_name"required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Nomor KTP</label>
                        <input type="text" name="national_id" class="form-control" id="detail_national_id" required maxlength="16">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Nama Pasangan</label>
                        <input type="text" name="partner_name" class="form-control" id="detail_partner_name">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Nomor KTP Pasangan</label>
                        <input type="text" name="partner_national_id" class="form-control" id="detail_partner_national_id" maxlength="16">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Umur / Tanggal Lahir</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="detail_old">9 tahun</span>
                            </div>
                            <input type="date" name="birth_date" class="form-control" id="detail_birth_date" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Tanggal Lahir Pasangan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="detail_partner_old">0 tahun</span>
                            </div>
                            <input type="date" name="partner_birth_date" class="form-control" id="detail_partner_birth_date">
                        </div>
                    </div>
                    <input type="hidden" name="status" value="ordered">
                    <div class="col-md-6 mb-2">
                        <label>Status Pembayaran</label>
                        <select name="payment_status" id="detail_payment_status" class="form-control" required>
                            <option value="">Pilih</option>
                            <option value="reject">Reject</option>
                            <option value="qualify">Qualify</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Solusi (jika reject)</label>
                        <select name="solution" id="detail_solution" class="form-control" disabled>
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
                <a href="javascript:void(0)" class="btn btn-warning btn-sm" id="edit-button"><i class="fas fa-pen"></i>
                    Edit</a>

                <form action="{{ route('customers.destroy', 'zero') }}" method="POST" id="form-delete"
                    class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                </form>

                <button class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times"></i>
                    Tutup</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        const formDelete = document.getElementById("form-delete")
        const editButton = document.getElementById("edit-button");

        document.querySelectorAll(".btn-detail").forEach((btn) => {
            const items = {
                "name": btn.dataset.name,
                "partnerName": btn.dataset.partnername,
                "NIK": btn.dataset.nik,
                "partnerNIK": btn.dataset.partnernik,
                "old": btn.dataset.old,
                "partnerOld": btn.dataset.partnerold,
                "unitGroup": btn.dataset.unitgroup,
                "unit": btn.dataset.unit,
                "deleteUrl": btn.dataset.deleteUrl,
                "editUrl": btn.dataset.editUrl
            }

            btn.addEventListener("click", () => {
                editButton.setAttribute("href", items.editUrl)
                formDelete.setAttribute('action', items.deleteUrl)
                document.getElementById("modalTable").innerHTML = `
        <tr>
            <th>Nama</th>
            <td>${items.name}</td>
        </tr>
        <tr>
            <th>Nama Pasangan</th>
            <td>${items.partnerName}</td>
        </tr>
        <tr>
            <th>NIK</th>
            <td>${items.NIK}</td>
        </tr>
        <tr>
            <th>NIK Pasangan</th>
            <td>${items.partnerNIK}</td>
        </tr>
        <tr>
            <th>Usia</th>
            <td>${items.old}</td>
        </tr>
        <tr>
            <th>Usia Pasangan</th>
            <td>${items.partnerOld}</td>
        </tr>
        <tr>
            <th>Unit Group</th>
            <td>${items.unitGroup}</td>
        </tr>
        <tr>
            <th>Unit</th>
            <td>${items.unit}</td>
        </tr>
        `
            })
        })
    </script>
    <script>
        let table = new DataTable('#customerTable', {
            responsive: true
        });
    </script>
@endpush
