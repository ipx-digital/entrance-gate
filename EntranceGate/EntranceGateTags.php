<?php

namespace Statamic\Addons\EntranceGate;

use Statamic\Extend\Tags;

class EntranceGateTags extends Tags
{
    /**
     * The {{ entrance_gate }} tag
     *
     * @return string|array
     */
    public function index()
    {
        $isActive = $this->getConfigBool('is_active', false);
        $notConfirmed = session('confirmed') != true;
        
        if ($isActive && $notConfirmed) {
            $code = '
                <div id="gate-wrapper" style="display: flex; justify-content: center; align-items: center; position: fixed; top: 0; left: 0; height: 100%; width: 100%; background-color: rgba(51, 50, 47, 0.9); z-index: 100;">
                    ' . $this->content . '
                </div>
            ';

        } else {
            $code = '';
        }

        return $code . $this->javascript();
    }

    /**
     * The {{ entrance_gate:over21 }} tag
     *
     * @return string|array
     */
    public function over21()
    {
        $isActive = $this->getConfigBool('is_active', false);
        $notConfirmed = session('confirmed') != true;

        if ($isActive && $notConfirmed) {
            $code = '
                <div id="gate-wrapper" style="display: flex; justify-content: center; align-items: center; position: fixed; top: 0; left: 0; height: 100%; width: 100%; background-color: rgba(51, 50, 47, 0.9); z-index: 100;">
                    <div style="padding: 2em; max-width: 550px; background-color: #fff;">
                        <h4 style="text-align: center; margin-bottom: 1em;">Are you over 21?</h4>
                        <p style="text-align: center;">You must be 21 or older to continue.</p>
                        <div style="margin-top: 2em; text-align: center;">
                            <button id="ConfirmGateYes" style="background-color: #eee; border: 2px solid #eee; padding: 0.25em 1.5em;">Yes</button>
                            <button id="ConfirmGateNo"  style="background-color: #fff; border: 2px solid #eee; padding: 0.25em 1.5em;">No</button>
                        </div>
                    </div>
                </div>
            ';

        } else {
            $code = '';
        }

        return $code . $this->javascript();
    }

    /**
     * The {{ entrance_gate:cookies }} tag
     *
     * @return string|array
     */
    public function cookies()
    {
        $isActive = $this->getConfigBool('is_active', false);
        $notConfirmed = session('confirmed') != true;

        if ($isActive && $notConfirmed) {
            $code = '
                <div id="gate-wrapper" style="display: flex; justify-content: center; align-items: center; position: fixed; top: 0; left: 0; height: 100%; width: 100%; background-color: rgba(51, 50, 47, 0.9); z-index: 100;">
                    <div style="padding: 2em; max-width: 550px; background-color: #fff;">
                        <h4 style="text-align: center; margin-bottom: 1em;">This website uses cookies</h4>
                        <p style="text-align: center;">Do you accept our use of cookies?</p>
                        <div style="margin-top: 2em; text-align: center;">
                            <button id="ConfirmGateYes" style="background-color: #eee; border: 2px solid #eee; padding: 0.25em 1.5em;">Yes</button>
                            <button id="ConfirmGateNo"  style="background-color: #fff; border: 2px solid #eee; padding: 0.25em 1.5em;">No</button>
                        </div>
                    </div>
                </div>
            ';

        } else {
            $code = '';
        }

        return $code . $this->javascript();
    }

    public function javascript()
    {
        $redirectUrl = $this->getConfig('redirect_url');

        return '<script>
        document.addEventListener("DOMContentLoaded", function() {
            document.body.style.overflow = "hidden";
            var wrapper = document.getElementById("gate-wrapper");
            if (wrapper) {
                var yes = document.getElementById("ConfirmGateYes");
                var no = document.getElementById("ConfirmGateNo");
                
                yes.addEventListener("click", function () {
                    var request = new XMLHttpRequest();
                    request.open("GET", "/!/EntranceGate/confirm", true);
                    request.onload = function() {
                      if (request.status >= 200 && request.status < 400) {
                        wrapper.parentNode.removeChild(wrapper);
                        document.body.style.overflow = "auto";
                      }
                    };
                    request.send();
                });

                no.addEventListener("click", function () {
                    window.location.href = "' . $redirectUrl . '";
                });
            }
        });
        </script>';
    }
}
