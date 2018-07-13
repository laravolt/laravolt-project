<form class="ui form">
    <h4 class="ui dividing header">Shipping Information</h4>
    <div class="field">
        <label>Name</label>
        <div class="two fields">
            <div class="field">
                <input type="text" name="shipping[first-name]" placeholder="First Name">
            </div>
            <div class="field">
                <input type="text" name="shipping[last-name]" placeholder="Last Name">
            </div>
        </div>
    </div>
    <div class="field">
        <label>Billing Address</label>
        <div class="fields">
            <div class="twelve wide field">
                <input type="text" name="shipping[address]" placeholder="Street Address">
            </div>
            <div class="four wide field">
                <input type="text" name="shipping[address-2]" placeholder="Apt #">
            </div>
        </div>
    </div>
    <div class="two fields">
        <div class="field">
            <label>State</label>
            <select class="ui fluid dropdown search">
                <option value="">State</option>
                <option value="AL">Alabama</option>
                <option value="AL">San Fransisco</option>
            </select>
        </div>
        <div class="field">
            <label>Country</label>
            <div class="ui fluid search selection dropdown">
                <input type="hidden" name="country">
                <i class="dropdown icon"></i>
                <div class="default text">Select Country</div>
                <div class="menu">
                    <div class="item" data-value="af"><i class="af flag"></i>Afghanistan</div>
                    <div class="item" data-value="zw"><i class="zw flag"></i>Zimbabwe</div>
                </div>
            </div>
        </div>
    </div>
    <h4 class="ui dividing header">Billing Information</h4>
    <div class="field">
        <label>Card Type</label>
        <div class="ui selection dropdown">
            <input type="hidden" name="card[type]">
            <div class="default text">Type</div>
            <i class="dropdown icon"></i>
            <div class="menu">
                <div class="item" data-value="visa">
                    <i class="visa icon"></i>
                    Visa
                </div>
                <div class="item" data-value="amex">
                    <i class="amex icon"></i>
                    American Express
                </div>
                <div class="item" data-value="discover">
                    <i class="discover icon"></i>
                    Discover
                </div>
            </div>
        </div>
    </div>
    <div class="fields">
        <div class="seven wide field">
            <label>Card Number</label>
            <input type="text" name="card[number]" maxlength="16" placeholder="Card #">
        </div>
        <div class="three wide field">
            <label>CVC</label>
            <input type="text" name="card[cvc]" maxlength="3" placeholder="CVC">
        </div>
        <div class="six wide field">
            <label>Expiration</label>
            <div class="two fields">
                <div class="field">
                    <select class="ui fluid search dropdown" name="card[expire-month]">
                        <option value="">Month</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                <div class="field">
                    <input type="text" name="card[expire-year]" maxlength="4" placeholder="Year">
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="ui button primary" tabindex="0">Submit Order</button>
    <a class="ui button">Cancel</a>
</form>
