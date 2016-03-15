{include file='includes/header.tpl'}
<script src="{$web.js}/jquery.autosize.min.js" type="text/javascript"></script>
<link href="{$web.css}/images.css" rel="stylesheet" type="text/css">
<input type="hidden" name="to_user" value="{$u_info.u_id}" />
<div class="profile-content clearfix">
{include file='i_profile/left.tpl'}
{include file='i_profile/main.tpl'}
{include file='i_profile/sidebar.tpl'}
</div>

{include file='includes/footer.tpl'}