<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Set Time</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body flex-box">
                <div style="color: #fff;">
                    <span>Please set a time for your meditation.</span>
                </div>
                <div style="color: #fff;">
                    <span>You can edit your meditation settings at the top left corner.</span>
                </div>
                <div class="flex-center" style="display: flex;margin-top: 20px;">
                    <div style="margin-top: 6px">
                        <span>Set Time：</span>
                    </div>
                    <div class="input-group">
                        <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)"
                            id="timeValue" min="1" max="10"
                            oninput="if(value> 10)value=10;if(value< 1)value=1" />
                        <div class="input-group-append">
                            <span class="input-group-text">min</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="button" class="color-btn btn btn-secondary" id="confirmButton" onclick="setTime()">
                    Start Meditation
                </button>
            </div>
        </div>
    </div>
</div>
