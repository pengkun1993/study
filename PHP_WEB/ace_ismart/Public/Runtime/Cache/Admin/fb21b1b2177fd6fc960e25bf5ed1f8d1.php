<?php if (!defined('THINK_PATH')) exit();?><table class="table tb-type2 nobdb">
  <tbody>
    <tr>
      <td colspan="2" class="required"><label for="for_name">用户权限:</label></td>
    </tr>
    <tr class="noborder">
      <td class="vatop rowform"><select name="group[]" class="easyui-combotree" style="height:30px;" data-options="value:'<?php echo ($_group_id); ?>',url:'<?php echo U("Admin/Function/get_auth_group");?>&r_type=json',valueField:'id',textField:'text',multiple:true,cascadeCheck:false,required:false,editable:false">
        </select></td>
      <td class="vatop tips"></td>
    </tr>
  </tbody>
</table>
<input name="id" type="hidden" value="<?php echo ($_info["id"]); ?>" />