<?php

namespace QcloudIM;

/**
 * Class Constants.
 */
class Constants
{
    /** @var string sdk版本号 */
    public const SDK_VERSION = '1.0.1';
    /** @var string 调用base uri */
    public const SDK_BASE_URI = 'https://console.tim.qq.com/v4/';
    /** @var int 重试次数 */
    public const SDK_RETRY_MAX_RETRIES = 1;

    /** @var string 后台接口返回类型 */
    public const ACTION_STATUS_OK = 'OK';
    public const ACTION_STATUS_FAIL = 'FAIL';
    /** @var int 自定义后台接口返回错误 */
    public const ERROR_CODE_CUSTOM = 99999;

    /** @var string 昵称 长度不得超过500个字节 */
    public const TAG_PROFILE_IM_NICK = 'Tag_Profile_IM_Nick';
    /** @var string  性别
     * Gender_Type_Unknown：没设置性别
     * Gender_Type_Female：女性
     * Gender_Type_Male：男性
     */
    public const TAG_PROFILE_IM_GENDER = 'Tag_Profile_IM_Gender';
    /** @var string 生日 推荐用法：20190419 */
    public const TAG_PROFILE_IM_BIRTHDAY = 'Tag_Profile_IM_BirthDay';
    /** @var string 所在地
     * 长度不得超过16个字节，推荐用法如下：
     * App 本地定义一套数字到地名的映射关系 后台实际保存的是4个 uint32_t 类型的数字
     * 其中第一个 uint32_t 表示国家
     * 第二个 uint32_t 用于表示省份
     * 第三个 uint32_t 用于表示城市
     * 第四个 uint32_t 用于表示区县
     */
    public const TAG_PROFILE_IM_LOCATION = 'Tag_Profile_IM_Location';
    /** @var string 个性签名 长度不得超过500个字节 */
    public const TAG_PROFILE_IM_SELFSIGNATURE = 'Tag_Profile_IM_SelfSignature';
    /** @var string    加好友验证方式
     * AllowType_Type_NeedConfirm：需要经过自己确认才能添加自己为好友
     * AllowType_Type_AllowAny：允许任何人添加自己为好友
     * AllowType_Type_DenyAny：不允许任何人添加自己为好友
     */
    public const TAG_PROFILE_IM_ALLOWTYPE = 'Tag_Profile_IM_AllowType';
    /** @var string 语言 */
    public const TAG_PROFILE_IM_LANGUAGE = 'Tag_Profile_IM_Language';
    /** @var string 头像URL 长度不得超过500个字节 */
    public const TAG_PROFILE_IM_IMAGE = 'Tag_Profile_IM_Image';
    /** @var string 消息设置 标志位：Bit0：置0表示接收消息，置1则不接收消息 */
    public const TAG_PROFILE_IM_MSGSETTINGS = 'Tag_Profile_IM_MsgSettings';
    /** @var string 管理员禁止加好友标识
     * AdminForbid_Type_None：默认值，允许加好友
     * AdminForbid_Type_SendOut：禁止该用户发起加好友请求
     */
    public const TAG_PROFILE_IM_ADMINFORBIDTYPE = 'Tag_Profile_IM_AdminForbidType';
    /** @var string  等级
     * 通常一个 UINT-8 数据即可保存一个等级信息 您可以考虑拆分保存，从而实现多种角色的等级信息
     */
    public const TAG_PROFILE_IM_LEVEL = 'Tag_Profile_IM_Level';
    /** @var string  角色
     * 通常一个 UINT-8 数据即可保存一个角色信息 您可以考虑拆分保存，从而保存多种角色信息
     */
    public const TAG_PROFILE_IM_ROLE = 'Tag_Profile_IM_Role';
    /** @var array 获取所有标配资料字段 */
    public const TAG_PROFILE_IM_ALL = [
        self::TAG_PROFILE_IM_NICK,
        self::TAG_PROFILE_IM_IMAGE,
        self::TAG_PROFILE_IM_GENDER,
        self::TAG_PROFILE_IM_BIRTHDAY,
        self::TAG_PROFILE_IM_LOCATION,
        self::TAG_PROFILE_IM_SELFSIGNATURE,
        self::TAG_PROFILE_IM_ALLOWTYPE,
        self::TAG_PROFILE_IM_LANGUAGE,
        self::TAG_PROFILE_IM_MSGSETTINGS,
        self::TAG_PROFILE_IM_ADMINFORBIDTYPE,
        self::TAG_PROFILE_IM_LEVEL,
        self::TAG_PROFILE_IM_ROLE,
    ];

    /** @var string 没设置性别 */
    public const GENDER_TYPE_UNKNOWN = 'Gender_Type_Unknown';
    /** @var string 女性 */
    public const GENDER_TYPE_FEMALE = 'Gender_Type_Female';
    /** @var string 男性 */
    public const GENDER_TYPE_MALE = 'Gender_Type_Male';

    /** @var string 需要经过自己确认才能添加自己为好友 */
    public const ALLOWTYPE_TYPE_NEEDCONFIRM = 'AllowType_Type_NeedConfirm';
    /** @var string 允许任何人添加自己为好友 */
    public const ALLOWTYPE_TYPE_ALLOWANY = 'AllowType_Type_AllowAny';
    /** @var string 不允许任何人添加自己为好友 */
    public const ALLOWTYPE_TYPE_DENYANY = 'AllowType_Type_DenyAny';

    /** @var string 默认值，允许加好友 */
    public const ADMINFORBID_TYPE_NONE = 'AdminForbid_Type_None';
    /** @var string 禁止该用户发起加好友请求 */
    public const ADMINFORBID_TYPE_SENDOUT = 'AdminForbid_Type_SendOut';

    /** @var string 群组形态，Private（即 Work，好友工作群） */
    public const GROUP_TYPE_PUBLIC = 'Public';
    /** @var string 群组形态，Public（陌生人社交群） */
    public const GROUP_TYPE_PRIVATE = 'Private';
    /** @var string 群组形态，ChatRoom（即 Meeting，会议群） */
    public const GROUP_TYPE_CHATROOM = 'ChatRoom';
    /** @var string 群组形态，AVChatRoom（直播群） */
    public const GROUP_TYPE_AV_CHATROOM = 'AVChatRoom';

    /** @var string 表示单向加好友 */
    public const FRIEND_ADD_TYPE_SIGNLE = 'Add_Type_Single';
    /** @var string 表示双向加好友 */
    public const FRIEND_ADD_TYPE_BOTH = 'Add_Type_Both';
    /** @var string 添加好友来源前缀 */
    public const ADD_SOURCE_TYPE_PREFIX = 'AddSource_Type_';

    /** @var string 表示单向删好友 */
    public const FRIEND_DELETE_TYPE_SIGNLE = 'Delete_Type_Single';
    /** @var string 表示双向删好友 */
    public const FRIEND_DELETE_TYPE_BOTH = 'Delete_Type_Both';

    /** @var string 单向校验好友关系 */
    public const FRIEND_CHECK_TYPE_SIGNLE = 'CheckResult_Type_Single';
    /** @var string 双向校验好友关系 */
    public const FRIEND_CHECK_TYPE_BOTH = 'CheckResult_Type_Both';

    /** @var string 单向校验黑名单关系 */
    public const BLACK_CHECK_TYPE_SIGNLE = 'BlackCheckResult_Type_Single';
    /** @var string 双向校验黑名单关系 */
    public const BLACK_CHECK_TYPE_BOTH = 'BlackCheckResult_Type_Both';

    /** @var string 好友关系结果 */
    public const FRIEND_CHECKRESULT_TYPE_NO_RELATION = 'CheckResult_Type_NoRelation';
    public const FRIEND_CHECKRESULT_TYPE_A_WITH_B = 'CheckResult_Type_AWithB';
    public const FRIEND_CHECKRESULT_TYPE_B_WITH_A = 'CheckResult_Type_BWithA';
    public const FRIEND_CHECKRESULT_TYPE_BOTH_WAY = 'CheckResult_Type_BothWay';

    /** @var string 黑名单关系结果 */
    public const FRIEND_BLACKCHECKRESULT_TYPE_NO = 'BlackCheckResult_Type_NO';
    public const FRIEND_BLACKCHECKRESULT_TYPE_A_WITH_B = 'BlackCheckResult_Type_AWithB';
    public const FRIEND_BLACKCHECKRESULT_TYPE_B_WITH_A = 'BlackCheckResult_Type_BWithA';
    public const FRIEND_BLACKCHECKRESULT_TYPE_BOTH_WAY = 'BlackCheckResult_Type_BothWay';

    /** @var string 好友分组
     * 1. 最多支持 32 个分组；
     * 2. 不允许分组名为空；
     * 3. 分组名长度不得超过 30 个字节；
     * 4. 同一个好友可以有多个不同的分组*/
    public const TAG_SNS_IM_GROUP = 'Tag_SNS_IM_Group';
    /** @var string 好友备注 备注长度最长不得超过 96 个字节 */
    public const TAG_SNS_IM_REMARK = 'Tag_SNS_IM_Remark';
    /** @var string  加好友来源
     * 1. 加好友来源字段包含前缀和关键字两部分；
     * 2. 加好友来源字段的前缀是：AddSource_Type_ ；
     * 3. 关键字：必须是英文字母，且长度不得超过 8 字节，建议用一个英文单词或该英文单词的缩写；
     * 4. 示例：加好友来源的关键字是 Android，则加好友来源字段是：AddSource_Type_Android*/
    public const TAG_SNS_IM_ADDSOURCE = 'Tag_SNS_IM_AddSource';
    /** @var string 加好友附言 加好友附言的长度最长不得超过 256 个字节 */
    public const TAG_SNS_IM_ADDWORDING = 'Tag_SNS_IM_AddWording';
    /** @var string 自定义好友字段的前缀  关键字：必须是英文字母，且长度不得超过 8 字节，建议用一个英文单词或该英文单词的缩写 */
    public const TAG_SNS_CUSTOM_PREFIX = 'Tag_SNS_Custom';

    /** @var string 消息类型，文本 */
    public const MSG_ELEMENT_TYPE_TEXT = 'TIMTextElem';
    /** @var string 消息类型，表情 */
    public const MSG_ELEMENT_TYPE_FACE = 'TIMFaceElem';
    /** @var string 消息类型，图片 */
    public const MSG_ELEMENT_TYPE_IMAGE = 'TIMImageElem';
    /** @var string 消息类型，自定义 */
    public const MSG_ELEMENT_TYPE_CUSTOM = 'TIMCustomElem';
    /** @var string 消息类型，语音(只支持显示) */
    public const MSG_ELEMENT_TYPE_SOUND = 'TIMSoundElem';
    /** @var string 消息类型，文件(只支持显示) */
    public const MSG_ELEMENT_TYPE_FILE = 'TIMFileElem';
    /** @var string 消息类型，地理位置 */
    public const MSG_ELEMENT_TYPE_LOCATION = 'TIMLocationElem';
    /** @var string 消息类型，群提示消息(只支持显示) */
    public const MSG_ELEMENT_TYPE_GROUP_TIP = 'TIMGroupTipElem';

    /** @var int 图片类型，原图 */
    public const IMAGE_TYPE_ORIGIN = 1;
    /** @var int 图片类型，缩略大图 */
    public const IMAGE_TYPE_LARGE = 2;
    /** @var int 图片类型，缩略小图 */
    public const IMAGE_TYPE_SMALL = 3;

    /** @var int 图片格式 */
    public const IMAGE_FORMAT_JPG = 0x1;
    public const IMAGE_FORMAT_JPEG = 0x1;
    public const IMAGE_FORMAT_GIF = 0x2;
    public const IMAGE_FORMAT_PNG = 0x3;
    public const IMAGE_FORMAT_BMP = 0x4;
    public const IMAGE_FORMAT_UNKNOWN = 0xFF;

    /** @var string 设置 NoLastMsg 的情况下，表示不更新最近联系人会话 */
    public const SENDMSGCONTROL_NO_LASTMSG = 'NoLastMsg';
    /** @var string NoUnread 不计未读，只对单条消息有效。(AVChatRoom 不允许使用) */
    public const SENDMSGCONTROL_NO_UNREAD = 'NoUnread';

    /** @var string 指定消息的优先级，默认优先级 Normal */
    public const MSG_PRIORITY_HIGH = 'High';
    public const MSG_PRIORITY_NORMAL = 'Normal';
    public const MSG_PRIORITY_LOW = 'Low';

    /** @var string 机器人账号前缀 */
    public const ROBOT_PREFIX = '@RBT#';

}
