> 本来是一年前的想法，但是但是在给学校写办公系统结果忘了弄，再加上windows的日历是很鸡肋的，就不了了之了。换了电脑以后发现mac的日历还是挺有用的，然后接趁着五一假期做了个小工具，方便把教务在线的课程导出。然而对大三的我只能用最后一学期了。。。

## 说明一下

`eol`是清华大学做的教务综合管理系统，俗称`教务在线`。可能各个学校的教务在线系统不一样，可能只适合我们学校这个，其他学校就得看着改改了。

[iCalendar](https://en.wikipedia.org/wiki/ICalendar)是一种日历文件格式，具体请点名称进维基百科。（并不是说明软件），开发的时候遵循的是[RFC5545](https://tools.ietf.org/html/rfc5545)（这是定义ical格式的标准）的标准。

## eol2ical

这是把清华eol版(哈尔滨理工大学)教务在线课表导出到ics格式的脚本

## demo

你可以到这里使用：[eolical](https://en.wikipedia.org/wiki/ICalendar)


## 可以使用的设备

下载得到的文件可以导入到`谷歌日历`,`iOS日历App`,`Mac日历App`....只要你的设备日历支持导入ics格式日历就行。

## 使用步骤

输入信息点击导出

![](http://ww2.sinaimg.cn/large/a15b4afegw1f3h3fl7yfuj216o1kw76q.jpg)

默认浏览器里，IOS或mac会自动打卡日历，其他浏览器请选择日历引用打开下载到的文件。

![](http://ww2.sinaimg.cn/large/a15b4afegw1f3h3frnw5lj216o1kw0wj.jpg)

可以新建一个日历。点完成。

![](http://ww2.sinaimg.cn/large/a15b4afegw1f3h3ftv8ymj216o1kw0uk.jpg)

在日历应用里打开相应的日历。就完成了！


![](http://ww2.sinaimg.cn/large/a15b4afegw1f3h3fhpdxuj216o0w0tat.jpg)
![](http://ww2.sinaimg.cn/large/a15b4afegw1f3h3fwvmioj216o1kwn0n.jpg)
![](http://ww2.sinaimg.cn/large/a15b4afegw1f3h3fd06b9j216o0w0gmv.jpg)
