全部独立模块的启用了3.2.1的，应用类库不使用命名空间的配置
    //应用类库不再需要使用命名空间
    'APP_USE_NAMESPACE'    =>    false,
    
模块下面如果有sql文件的，需要导入到mysql数据库中
    
    
    
已知的bug:     Rbac模块
1、在列表记录少于10条时，分页未显示
    
    
##目录


Ajax            Ajax表单提交
Curd            数据表Curd
File            图片上传
Form            表单提交
Group           原3.1版本的独立分组，3.21版本的独立模块,后台统一调用Rbac   
Hello           显示Hello，模版视图使用示例
Home            系统自动生成的前台
Lang            多语言
Page            表格数据分页
Rbac            后台管理模块，Rbac权限控制。已经完成重写了。还有一些bug未修正
Relation        数据表的关联操作
Route           URL路由处理    
Template_extend 模板继承
Theme           模板主题
Trace           页面Trace