<div id="content"  class="signup">
{if $isServerStarted}
{if empty($code) and !empty($activate)}
<h1><img src="assets/img/x.gif" class="anmelden" alt="register for the game"></h1> 
        <h5><img src="assets/img/x.gif" class="img_u05" alt="registration"/></h5> 
            <p> 
                Hello {$activate}, 
<br /><br />
                The registration was successful. In the next few minutes you will receive an email with the access information. 
<br /><br /> 
The email will be sent to following address: <span class="important">{$email}</span> 
            </p> 
            <p>In order to activate your account enter the code or click on the link in your email.</p> 
            <div id="activation"> 
                <form action="activate.php" method="post"> 
                    <p class="important"> 
                        Activation code: 
                    </p> 
                    <input class="text" type="text" name="code" maxlength="10" /> 
                    <p> 
                        <button id="btn_send" value="activate" name="action" class="trav_buttons"> Send </button>
                    </p> 
                </form> 
                </div> 
                <div id="no_mail"> 
                	<p> 
                    	<a href="activate.php?del={$activate}"><span class="important">No email received?</span></a>
                	</p> 
                	<p> 
                    	Sometimes the email is moved to the spam folder. <br />For further help click <a href="activate.php?del={$activate}">here</a> 
                	</p> 
            	</div>
{else}
            <div id="activation"> 
                <form action="activate.php" method="post"> 
                    <p class="important"> 
                        Activation code:
                    </p> 
                    <input class="text" type="text" name="code" maxlength="10" value="{$code}"/>
                    <p>
                    	<span class="error">{$codeError}</span>
                    </p>
                    <p>                                 
                    	<button id="btn_send" value="activate" name="action" class="trav_buttons"> Send </button>
                    </p>
                </form>
            </div>
{/if} 
{else}
<br/>
<div style="text-align: center"><big>Activation Available in: </big></div>
<div class="timer" id="activation_time">{$serverStartsIn}</div>
{/if}
</div> 