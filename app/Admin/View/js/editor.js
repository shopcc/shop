var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="goods_desc"]', {
					resizeType : 1,
					allowPreviewEmoticons : true,
					allowFileManager : true,
					allowImageUpload : true,
					allowImageManager : true,
						
						afterBlur:function(){this.sync();}
				});
					
				
			});