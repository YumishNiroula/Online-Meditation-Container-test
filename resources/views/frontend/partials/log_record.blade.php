<div class="modal fade" id="examplehistoryRecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 800px" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">
                    Logs
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="testTable">
                <div id="logsContainer">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Login Time</th>
                                <th scope="col">Meditation Time</th>
                                <th scope="col">Feelings Before</th>
                                <th scope="col">Feelings After</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $key => $log)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $log->login_time }}</td>
                                    <td>{{ $log->meditation_time }}</td>
                                    <td>{{ $log->feelings_before }}</td>
                                    <td>{{ $log->feelings_after }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="color-btn btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
