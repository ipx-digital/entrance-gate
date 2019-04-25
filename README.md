## Installation

Unzip and place the `EntranceGate` directory in your `site/addons` directory.

Use the tags below on any page(s) you wish to request confirmation before allowing access.

Toggle the switch in the Addons > Entrance Gate > Active to start gating users.

## Usage

This plugin includes two default tags to get you up and running quickly, as well as a general tag so that you can customize your confirmation modal.

"Yes" confirmations are stored in the session and only need to be made once per session.

### Default 21+ Age Checker

Simply add the tag `{{ entrance_gate:over21 }}` to any layout or page to check if a user is over 21 before granting access.

### Default Cookie Approval

Using `{{ entrance_gate:cookies }}` will load a plugin-default modal requesting approval of site-cookies.

### Custom Confirmation Modal

You may use the generic tag to design any confirmation modal you want.

Add `id="ConfirmGateYes"` to the button/link/element you wish to use for the "yes" action, and `id="ConfirmGateNo"` to any button/link/element for the "no" action. The tag includes Javascript that looks for 'onclick' events for an element with each of those IDs.

#### Example:

Adding the following to the `layouts/default` file will include the check on every page using the default layout:

```html
    {{ entrance_gate }}
        <div style="padding: 2em; max-width: 550px; background-color: #fff;">
            <h4 style="text-align: center;">
            	Do you want to enter?
            </h4>
            <p style="text-align: center;">
            	This is a custom box.
            </p>
            <div style="margin-top: 2em; text-align: center;">
                <button id="ConfirmGateYes" style="background-color: #eee; border: 2px solid #eee; padding: 0.25em 1.5em;">
                	Yes
                </button>
                <button id="ConfirmGateNo" style="background-color: #fff; border: 2px solid #eee; padding: 0.25em 1.5em;">
                	No
                </button>
            </div>
        </div>
    {{ /entrance_gate }}
```

**Notes**

For those making a custom form, there are a few things to note.

The `{{ entrance_gate }}` tag will:

* apply a full-screen wrapper that will grey-out the background
* vertically and horizontally center the div included inside the tag using flexbox
