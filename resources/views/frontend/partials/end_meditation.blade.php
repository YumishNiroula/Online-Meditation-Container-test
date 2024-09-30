<div class="modal fade" id="confirmModalReturn" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">End Meditation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 20px;font-size: 18px;">
                <div style="color: #fff;">
                    <span>Are you sure you want to end your meditation? <br>Please select your answers to the
                        questions below.</span>
                </div>
                <div style="color: #fff; text-align: left;margin-top: 20px;">
                    <span>How stressed did you feel before your meditation?</span>
                </div>
                <div class="checkout" style="padding: 20px 0;color: #fff;text-align: left;">
                    <label style="margin-right: 10px;">
                        <input style="width: 15px;height: 15px;" type="radio" name="stressLevel1" value="0"
                            class="stress-radio">
                        0: No Stress
                    </label>
                    <label style="margin-right: 10px;">
                        <input style="width: 15px;height: 15px;" type="radio" name="stressLevel1" value="1"
                            class="stress-radio">
                        1: Some Stress
                    </label>
                    <label style="margin-right: 10px;">
                        <input style="width: 15px;height: 15px;" type="radio" name="stressLevel1" value="2"
                            class="stress-radio">
                        2: A Lot of Stress
                    </label>
                </div>

                <div style="color: #fff;text-align: left;">
                    <span>How stressed are you feeling now?</span>
                </div>
                <div class="checkout" style="padding: 20px 0;color: #fff;text-align: left;">
                    <label style="margin-right: 10px;">
                        <input style="width: 15px;height: 15px;" type="radio" name="stressLevel2" value="0"
                            class="stress-radio">
                        0: No Stress
                    </label>
                    <label style="margin-right: 10px;">
                        <input style="width: 15px;height: 15px;" type="radio" name="stressLevel2" value="1"
                            class="stress-radio">
                        1: Some Stress
                    </label>
                    <label style="margin-right: 10px;">
                        <input style="width: 15px;height: 15px;" type="radio" name="stressLevel2" value="2"
                            class="stress-radio">
                        2: A Lot of Stress
                    </label>
                </div>
                <div style="color: #fff; text-align: center;">
                    <span>Thank you for meditating today! Hope to see you again soon</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="color-btn btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="color-btn btn btn-secondary" id="confirmButton"
                    onclick="returnHome()">Confirm</button>
            </div>
        </div>
    </div>
</div>
