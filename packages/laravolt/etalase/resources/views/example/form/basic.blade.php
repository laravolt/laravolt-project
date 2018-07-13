<form class="ui form">
    <div class="field">
        <label>First Name</label>
        <input type="text" name="first-name" placeholder="First Name">
    </div>
    <div class="field">
        <label>Last Name</label>
        <input type="text" name="last-name" placeholder="Last Name">
    </div>
    <div class="field">
        <label>Nationality</label>
        <select class="ui dropdown search">
            <option value="1">Indonesia</option>
            <option value="2">Malaysia</option>
            <option value="3">Thailand</option>
        </select>
    </div>

    <div class="field">
        <label>Hobby</label>
        <div class="inline fields">
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" name="hobby[]">
                    <label>Coding</label>
                </div>
            </div>
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" name="hobby[]">
                    <label>Gaming</label>
                </div>
            </div>
        </div>
    </div>

    <div class="field">
        <label>Gender</label>
        <div class="field">
            <div class="ui checkbox radio">
                <input type="radio" name="gender">
                <label>Male</label>
            </div>
        </div>
        <div class="field">
            <div class="ui checkbox radio">
                <input type="radio" name="gender">
                <label>Female</label>
            </div>
        </div>
    </div>

    <div class="field">
        <label>Do you have any feedback for us?</label>
        <textarea rows="5"></textarea>
    </div>

    <div class="ui divider hidden"></div>
    <div class="field">
        <div class="ui checkbox">
            <input type="checkbox">
            <label>I agree to the Terms and Conditions</label>
        </div>
    </div>
    <div class="ui divider hidden"></div>

    <button class="ui button primary" type="submit">Submit</button>
    <a class="ui button">Cancel</a>
</form>
