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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold" id="detailCustomerModalLabel">Detail Customer</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <table class="table table-bordered table-sm" id="modalTable">
                    <tr>
                        <th>Nama</th>
                        <td>Andi Saputra</td>
                    </tr>
                    <tr>
                        <th>Nama Pasangan</th>
                        <td>Siti Nurhaliza</td>
                    </tr>
                    <tr>
                        <th>NIK</th>
                        <td>1234567890123456</td>
                    </tr>
                    <tr>
                        <th>NIK Pasangan</th>
                        <td>6543210987654321</td>
                    </tr>
                    <tr>
                        <th>Usia</th>
                        <td>30 tahun</td>
                    </tr>
                    <tr>
                        <th>Usia Pasangan</th>
                        <td>28 tahun</td>
                    </tr>
                    <tr>
                        <th>Unit Group</th>
                        <td>A1</td>
                    </tr>
                    <tr>
                        <th>Unit</th>
                        <td>07</td>
                    </tr>
                </table>
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
