<link href="addbut.css" rel="stylesheet" type="text/css"/>
<script src="prevent.js"></script>
<div class="contain2" id="contain2" onmousedown="drag2(event)">
<div class="dtitle">导诊窗口</div>
<div class="mesframe" id="mesframe2">
<div class="content" id="content2"></div>
<div class="send">
<textarea name="sendtext" class="sendinput" id="sendmes2" placeholder="请输入疾病的症状，我们将会给您推荐挂号信息。查询信息格式为：关键词##关键词##关键词...以此类推。"></textarea><br />
<input type="button" value="发送" id="sendbut2" class="sendbut" onclick="sendtext2()"/>
</div>
</div>
</div>

<div class="recommend" onclick="showrecommend()">
<img src="wa.png" width="50px" height="50px"/>
</div>