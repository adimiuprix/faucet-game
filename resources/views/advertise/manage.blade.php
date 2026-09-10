<x-dash-layout>
    <!-- ########## main content ########## -->
    <div class="content-wrap">
        <!-- top row -->
        <x-topbar />
        
        <!-- #### dashboard main content #### -->
        <div class="main-content">
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
            <div class="container-fluid">
                <div class="row section px-2">
                    <div class="col-12">
                        <div class="common_card">
                            <h2 class="section_title">Manage ADS</h2>
                            <div class="table-responsive">
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Url</th>
                                            <th>Price ($)</th>
                                            <th>Timer</th>
                                            <th>Completed Views</th>
                                            <th>Total Views</th>
                                            <th>Premium</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                .modal-backdrop.fade.show {
                    display: none !important;
                }
            </style>
        </div>
    </div>
</x-dash-layout>