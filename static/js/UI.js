var UI = {
	//加载模态框
	alert:function (obj) {
		var title =(obj ==undefined || obj.title == undefined) ? '系统提示' : obj.title;
		var msg =(obj==undefined || obj.msg == undefined) ? '默认信息' : obj.msg;
		var icon =(obj==undefined || obj.icon == undefined) ? 'alert' : obj.icon;
		var html = '<div class="modal fade" tabindex="-1" role="dialog" id="UI-alert-sm">\
			  <div class="modal-dialog modal-sm" role="document">\
			    <div class="modal-content">\
			      <div class="modal-header">\
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
			        <h4 class="modal-title">'+title+'</h4>\
			      </div>\
			      <div class="modal-body">\
			        <p><img src="/static/images/'+icon+'.png" style="width:32px;height:32px;margin-right:5px;"/>'+msg+'</p>\
			      </div>\
			      <div class="modal-footer">\
			        <button type="button" class="btn btn-primary" onclick="$(\'#UI-alert-sm\').modal(\'hide\')">确定</button>\
			      </div>\
			    </div>\
			  </div>\
			</div>\
';
         $('body').append(html)
		 $('#UI-alert-sm').modal({backdrop:'static'})
         $('#UI-alert-sm').modal('show')
         $('#UI-alert-sm').on('hidden.bs.modal',function(e){
         	$('#UI-alert-sm').remove()
         })
	},

	//加载页面
	open:function(obj){
		var title =(obj ==undefined || obj.title == undefined) ? '' : obj.title;
		var url =(obj ==undefined || obj.url == undefined) ? '' : obj.url;
		var width =(obj ==undefined || obj.width == undefined) ? '550' : obj.width;
		var height =(obj ==undefined || obj.height == undefined) ? '450' : obj.height;
		var html = '<div class="modal fade" tabindex="-1" role="dialog" id="UI-open-lg">\
			  <div class="modal-dialog modal-lg" role="document">\
			    <div class="modal-content">\
			      <div class="modal-header">\
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
			        <h4 class="modal-title">'+title+'</h4>\
			      </div>\
			      <div class="modal-body">\
			       <iframe src="'+obj.url+'" style="width:100%;height:100%;" frameborder="0">\
			      </div>\
			    </div>\
			  </div>\
			</div>\
';
         $('body').append(html)
         $('#UI-open-lg .modal-lg').css('width',width)
         $('#UI-open-lg .modal-body').css('height',height)
		 $('#UI-open-lg').modal({backdrop:'static'})
         $('#UI-open-lg').modal('show')
         $('#UI-open-lg').on('hidden.bs.modal',function(e){
         	$('#UI-open-lg').remove()
         })
	}
	
}