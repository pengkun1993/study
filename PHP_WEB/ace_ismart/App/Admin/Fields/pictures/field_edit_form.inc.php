<table width="100%">
  <tr>
    <th>图片添加类型:</th>
    <td><select name="extra[updata_type]" style="height:30px;" class="easyui-combobox">
        <option value="0" <?php if($extra['updata_type']=='0'){?>selected="selected"<?php }?>>文本框类型</option>
        <option value="1" <?php if($extra['updata_type']=='1'){?>selected="selected"<?php }?>>图片框类型</option>
      </select></td>
  </tr>
  <tr>
    <th>图片数量类型:</th>
    <td><select name="extra[num_type]" style="height:30px;" class="easyui-combobox">
        <option value="0" <?php if($extra['num_type']=='0'){?>selected="selected"<?php }?>>单图片</option>
        <option value="1" <?php if($extra['num_type']=='1'){?>selected="selected"<?php }?>>多图片</option>
      </select>如果是多图片类型,请设置 “字段定义” 中的数据长度</td>
  </tr>
</table>
