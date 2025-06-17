/*
 Navicat Premium Data Transfer

 Source Server         : SQL LOCAL
 Source Server Type    : SQL Server
 Source Server Version : 15002080
 Source Host           : DESKTOP-V13VFU1\SQLEXPRESS:1433
 Source Catalog        : galaxy
 Source Schema         : dbo

 Target Server Type    : SQL Server
 Target Server Version : 15002080
 File Encoding         : 65001

 Date: 11/05/2022 10:17:51
*/


-- ----------------------------
-- Table structure for bm_currencies_id_all
-- ----------------------------
IF EXISTS (SELECT * FROM sys.all_objects WHERE object_id = OBJECT_ID(N'[dbo].[bm_currencies_id_all]') AND type IN ('U'))
	DROP TABLE [dbo].[bm_currencies_id_all]
GO

CREATE TABLE [dbo].[bm_currencies_id_all] (
  [id] int  IDENTITY(1,1) NOT NULL,
  [currency_code] nvarchar(3) COLLATE SQL_Latin1_General_CP1_CI_AS  NOT NULL,
  [currency_name] nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS  NOT NULL,
  [created_by] int  NOT NULL,
  [updated_by] int  NOT NULL,
  [created_at] datetime  NULL,
  [updated_at] datetime  NULL,
  [deleted_at] datetime  NULL,
  [currency_status] int DEFAULT 1 NOT NULL
)
GO

ALTER TABLE [dbo].[bm_currencies_id_all] SET (LOCK_ESCALATION = TABLE)
GO


-- ----------------------------
-- Records of bm_currencies_id_all
-- ----------------------------
SET IDENTITY_INSERT [dbo].[bm_currencies_id_all] ON
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'1', N'AED', N'United Arab Emirates Dirham', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'2', N'AFN', N'Afghanistan Afghani', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'3', N'ALL', N'Albania Lek', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'4', N'AMD', N'Armenia Dram', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'5', N'ANG', N'Netherlands Antilles Guilder', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'6', N'AOA', N'Angola Kwanza', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'7', N'ARS', N'Argentina Peso', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'8', N'AUD', N'Australia Dollar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'9', N'AWG', N'Aruba Guilder', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'10', N'AZN', N'Azerbaijan Manat', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'11', N'BAM', N'Bosnia and Herzegovina Convertible Mark', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'12', N'BBD', N'Barbados Dollar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'13', N'BDT', N'Bangladesh Taka', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'14', N'BGN', N'Bulgaria Lev', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'15', N'BHD', N'Bahrain Dinar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'16', N'BIF', N'Burundi Franc', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'17', N'BMD', N'Bermuda Dollar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'18', N'BND', N'Brunei Darussalam Dollar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'19', N'BOB', N'Bolivia Bolíviano', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'20', N'BRL', N'Brazil Real', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'21', N'BSD', N'Bahamas Dollar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'22', N'BTN', N'Bhutan Ngultrum', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'23', N'BWP', N'Botswana Pula', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'24', N'BYN', N'Belarus Ruble', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'25', N'BZD', N'Belize Dollar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'26', N'CAD', N'Canada Dollar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'27', N'CDF', N'Congo/Kinshasa Franc', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'28', N'CHF', N'Switzerland Franc', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'29', N'CLP', N'Chile Peso', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'30', N'CNY', N'China Yuan Renminbi', N'1', N'1', NULL, NULL, NULL, N'1')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'31', N'COP', N'Colombia Peso', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'32', N'CRC', N'Costa Rica Colon', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'33', N'CUC', N'Cuba Convertible Peso', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'34', N'CUP', N'Cuba Peso', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'35', N'CVE', N'Cape Verde Escudo', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'36', N'CZK', N'Czech Republic Koruna', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'37', N'DJF', N'Djibouti Franc', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'38', N'DKK', N'Denmark Krone', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'39', N'DOP', N'Dominican Republic Peso', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'40', N'DZD', N'Algeria Dinar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'41', N'EGP', N'Egypt Pound', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'42', N'ERN', N'Eritrea Nakfa', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'43', N'ETB', N'Ethiopia Birr', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'44', N'EUR', N'Euro Member Countries', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'45', N'FJD', N'Fiji Dollar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'46', N'FKP', N'Falkland Islands (Malvinas) Pound', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'47', N'GBP', N'United Kingdom Pound', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'48', N'GEL', N'Georgia Lari', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'49', N'GGP', N'Guernsey Pound', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'50', N'GHS', N'Ghana Cedi', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'51', N'GIP', N'Gibraltar Pound', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'52', N'GMD', N'Gambia Dalasi', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'53', N'GNF', N'Guinea Franc', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'54', N'GTQ', N'Guatemala Quetzal', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'55', N'GYD', N'Guyana Dollar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'56', N'HKD', N'Hong Kong Dollar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'57', N'HNL', N'Honduras Lempira', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'58', N'HRK', N'Croatia Kuna', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'59', N'HTG', N'Haiti Gourde', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'60', N'HUF', N'Hungary Forint', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'61', N'IDR', N'Indonesia Rupiah', N'1', N'1', NULL, NULL, NULL, N'1')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'62', N'ILS', N'Israel Shekel', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'63', N'IMP', N'Isle of Man Pound', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'64', N'INR', N'India Rupee', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'65', N'IQD', N'Iraq Dinar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'66', N'IRR', N'Iran Rial', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'67', N'ISK', N'Iceland Krona', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'68', N'JEP', N'Jersey Pound', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'69', N'JMD', N'Jamaica Dollar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'70', N'JOD', N'Jordan Dinar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'71', N'JPY', N'Japan Yen', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'72', N'KES', N'Kenya Shilling', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'73', N'KGS', N'Kyrgyzstan Som', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'74', N'KHR', N'Cambodia Riel', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'75', N'KMF', N'Comorian Franc', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'76', N'KPW', N'Korea (North) Won', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'77', N'KRW', N'Korea (South) Won', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'78', N'KWD', N'Kuwait Dinar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'79', N'KYD', N'Cayman Islands Dollar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'80', N'KZT', N'Kazakhstan Tenge', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'81', N'LAK', N'Laos Kip', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'82', N'LBP', N'Lebanon Pound', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'83', N'LKR', N'Sri Lanka Rupee', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'84', N'LRD', N'Liberia Dollar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'85', N'LSL', N'Lesotho Loti', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'86', N'LYD', N'Libya Dinar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'87', N'MAD', N'Morocco Dirham', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'88', N'MDL', N'Moldova Leu', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'89', N'MGA', N'Madagascar Ariary', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'90', N'MKD', N'Macedonia Denar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'91', N'MMK', N'Myanmar (Burma) Kyat', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'92', N'MNT', N'Mongolia Tughrik', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'93', N'MOP', N'Macau Pataca', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'94', N'MRU', N'Mauritania Ouguiya', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'95', N'MUR', N'Mauritius Rupee', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'96', N'MVR', N'Maldives (Maldive Islands) Rufiyaa', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'97', N'MWK', N'Malawi Kwacha', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'98', N'MXN', N'Mexico Peso', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'99', N'MYR', N'Malaysia Ringgit', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'100', N'MZN', N'Mozambique Metical', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'101', N'NAD', N'Namibia Dollar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'102', N'NGN', N'Nigeria Naira', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'103', N'NIO', N'Nicaragua Cordoba', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'104', N'NOK', N'Norway Krone', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'105', N'NPR', N'Nepal Rupee', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'106', N'NZD', N'New Zealand Dollar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'107', N'OMR', N'Oman Rial', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'108', N'PAB', N'Panama Balboa', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'109', N'PEN', N'Peru Sol', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'110', N'PGK', N'Papua New Guinea Kina', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'111', N'PHP', N'Philippines Peso', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'112', N'PKR', N'Pakistan Rupee', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'113', N'PLN', N'Poland Zloty', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'114', N'PYG', N'Paraguay Guarani', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'115', N'QAR', N'Qatar Riyal', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'116', N'RON', N'Romania Leu', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'117', N'RSD', N'Serbia Dinar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'118', N'RUB', N'Russia Ruble', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'119', N'RWF', N'Rwanda Franc', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'120', N'SAR', N'Saudi Arabia Riyal', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'121', N'SBD', N'Solomon Islands Dollar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'122', N'SCR', N'Seychelles Rupee', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'123', N'SDG', N'Sudan Pound', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'124', N'SEK', N'Sweden Krona', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'125', N'SGD', N'Singapore Dollar', N'1', N'1', NULL, NULL, NULL, N'1')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'126', N'SHP', N'Saint Helena Pound', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'127', N'SLL', N'Sierra Leone Leone', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'128', N'SOS', N'Somalia Shilling', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'129', N'SPL', N'Seborga Luigino', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'130', N'SRD', N'Suriname Dollar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'131', N'STN', N'São Tomé and Príncipe Dobra', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'132', N'SVC', N'El Salvador Colon', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'133', N'SYP', N'Syria Pound', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'134', N'SZL', N'eSwatini Lilangeni', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'135', N'THB', N'Thailand Baht', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'136', N'TJS', N'Tajikistan Somoni', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'137', N'TMT', N'Turkmenistan Manat', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'138', N'TND', N'Tunisia Dinar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'139', N'TOP', N'Tonga Pa''anga', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'140', N'TRY', N'Turkey Lira', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'141', N'TTD', N'Trinidad and Tobago Dollar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'142', N'TVD', N'Tuvalu Dollar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'143', N'TWD', N'Taiwan New Dollar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'144', N'TZS', N'Tanzania Shilling', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'145', N'UAH', N'Ukraine Hryvnia', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'146', N'UGX', N'Uganda Shilling', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'147', N'USD', N'United States Dollar', N'1', N'1', NULL, NULL, NULL, N'1')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'148', N'UYU', N'Uruguay Peso', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'149', N'UZS', N'Uzbekistan Som', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'150', N'VEF', N'Venezuela Bolívar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'151', N'VND', N'Viet Nam Dong', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'152', N'VUV', N'Vanuatu Vatu', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'153', N'WST', N'Samoa Tala', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'154', N'XAF', N'CFA Franc BEAC', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'155', N'XCD', N'East Caribbean Dollar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'156', N'XDR', N'International Monetary Fund (IMF) Special Drawing Rights', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'157', N'XOF', N'Communauté Financière Africaine (BCEAO) Franc', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'158', N'XPF', N'Comptoirs Français du Pacifique (CFP) Franc', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'159', N'YER', N'Yemen Rial', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'160', N'ZAR', N'South Africa Rand', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'161', N'ZMW', N'Zambia Kwacha', N'1', N'1', NULL, NULL, NULL, N'0')
GO

INSERT INTO [dbo].[bm_currencies_id_all] ([id], [currency_code], [currency_name], [created_by], [updated_by], [created_at], [updated_at], [deleted_at], [currency_status]) VALUES (N'162', N'ZWD', N'Zimbabwe Dollar', N'1', N'1', NULL, NULL, NULL, N'0')
GO

SET IDENTITY_INSERT [dbo].[bm_currencies_id_all] OFF
GO


-- ----------------------------
-- Auto increment value for bm_currencies_id_all
-- ----------------------------
DBCC CHECKIDENT ('[dbo].[bm_currencies_id_all]', RESEED, 162)
GO


-- ----------------------------
-- Primary Key structure for table bm_currencies_id_all
-- ----------------------------
ALTER TABLE [dbo].[bm_currencies_id_all] ADD CONSTRAINT [PK__bm_curre__3213E83F9D4D0962] PRIMARY KEY CLUSTERED ([id])
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)  
ON [PRIMARY]
GO

