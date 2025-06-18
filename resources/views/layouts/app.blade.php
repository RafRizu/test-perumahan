<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-Perumahan</title>

    <!-- Sb Admin Bootstrap css -->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Data Tables Css -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.css" />

    @stack('styles')
</head>

<body class="bg-gray-100 @stack('body-class')">

    <div id="wrapper">

        @auth
            @include('partials.sidebar')

            @include('partials.topbar')
        @endauth

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" class="container">
                @yield('content')
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Dahayu Bumi Sejahtera 2025</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ready to Logout?</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close"><span>×</span></button>
                </div>
                <div class="modal-body">Klik "Logout" untuk mengakhiri sesi kamu saat ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery 3.6.0  -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <!-- Bootstrap Bundled JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/jquery.easing@1.4.1/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.js') }}"></script>

    <!-- Data Tables Js -->
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>

    <!-- WARNING: For chart later: Page level plugins -->
    <!-- <script src="vendor/chart.js/Chart.min.js"></script> -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentStatus = document.getElementById('payment_status');
            const solutionBox = document.getElementById('solution_box');
            const solutionSelect = document.getElementById('solution')
            paymentStatus.addEventListener('change', function() {
                if (this.value === 'reject' || this.value === 'solution') {
                    solutionSelect.removeAttribute("disabled");
                } else {
                    solutionSelect.setAttribute("disabled", "true");
                }
            });

            const unitGroup = document.getElementById('unit_group_id');
            const unitSelect = document.getElementById('unit_id');

            unitGroup.addEventListener('change', function() {
                const groupId = this.value;

                // Show loading option
                unitSelect.innerHTML = '<option value="">Loading...</option>';
                unitSelect.disabled = true;

                if (groupId) {
                    fetch(`/api/unit-groups/${groupId}/units`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Clear existing options
                            unitSelect.innerHTML = '<option value="">Select Unit</option>';

                            if (data.length > 0) {
                                data.forEach(unit => {
                                    const option = document.createElement('option');
                                    option.value = unit.id;
                                    option.textContent = unit.name;
                                    unitSelect.appendChild(option);
                                });
                            } else {
                                const option = document.createElement('option');
                                option.value = '';
                                option.textContent = 'No units available';
                                unitSelect.appendChild(option);
                            }

                            unitSelect.disabled = false;
                        })
                        .catch(error => {
                            console.error('Error fetching units:', error);
                            unitSelect.innerHTML = '<option value="">Failed to load units</option>';
                            unitSelect.disabled = false;
                        });
                } else {
                    unitSelect.innerHTML = '<option value="">Select Unit</option>';
                    unitSelect.disabled = false;
                }
            });
            document.getElementById('national_id').addEventListener('input', function(e) {
                this.value = this.value.replace(/\D/g, '').slice(0, 16);
            });
            document.getElementById('partner_national_id').addEventListener('input', function(e) {
                this.value = this.value.replace(/\D/g, '').slice(0, 16);
            });
        });
    </script>


    <script>
        function showCreateCustomerModal(unitId, groupId, unitName, groupName) {
            document.getElementById('create_unit_id').value = unitId;
            document.getElementById('create_unit_group_id').value = groupId;
            document.getElementById('create_unit_name').value = unitName;
            document.getElementById('create_unit_group_name').value = groupName;

            document.getElementById('create_payment_status').value = '';
            document.getElementById('create_solution').value = '';
            document.getElementById('create_solution').disabled = true;

            new bootstrap.Modal(document.getElementById('createCustomerModal')).show();
        }

        function showDetailCustomerModal(unitId, unitName, groupName, customer) {
            document.getElementById('detail_unit_name').textContent = unitName;
            document.getElementById('detail_unit_group_name').textContent = groupName;

            document.getElementById('detail_name').textContent = customer.name;
            document.getElementById('detail_national_id').textContent = customer.national_id;
            document.getElementById('detail_birth_date').textContent = customer.birth_date;
            document.getElementById('detail_payment_status').textContent = customer.payment_status;
            document.getElementById('detail_solution').textContent = customer.solution ?? '-';

            new bootstrap.Modal(document.getElementById('detailCustomerModal')).show();
        }

        // enable solution input when reject selected
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('create_payment_status').addEventListener('change', function() {
                const solution = document.getElementById('create_solution');
                solution.disabled = this.value !== 'reject';
            });
        });
    </script>

@push('scripts')
<script>
function showDetailCustomerModal(name, partnerName, NIK, partnerNIK, old, partnerOld, unitGroup, unit, editUrl, deleteUrl) {
    document.getElementById("modalTable").innerHTML = `
        <tr><th>Nama</th><td>${name}</td></tr>
        <tr><th>Nama Pasangan</th><td>${partnerName}</td></tr>
        <tr><th>NIK</th><td>${NIK}</td></tr>
        <tr><th>NIK Pasangan</th><td>${partnerNIK}</td></tr>
        <tr><th>Usia</th><td>${old}</td></tr>
        <tr><th>Usia Pasangan</th><td>${partnerOld}</td></tr>
        <tr><th>Unit Group</th><td>${unitGroup}</td></tr>
        <tr><th>Unit</th><td>${unit}</td></tr>
    `;
    document.getElementById("edit-button").setAttribute("href", editUrl);
    document.getElementById("form-delete").setAttribute("action", deleteUrl);

    const modal = new bootstrap.Modal(document.getElementById('detailCustomerModal'));
    modal.show();
}
</script>
@endpush


    @stack('scripts')
</body>

</html>
