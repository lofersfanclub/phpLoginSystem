use tapnordic_db;

CREATE TABLE advertisers
(
    advetiser_id INT NOT NULL AUTO_INCREMENT,
    advetiser_name VARCHAR(255) DEFAULT "Unnamed Campaign",
    advertiser_profile_image VARCHAR(255) DEFAULT "http://via.placeholder.com/300x300",
    advertiser_created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    advertiser_updated datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (advetiser_id)
);

CREATE TABLE campaigns
(
    campaign_id INT NOT NULL AUTO_INCREMENT,
    campaign_name VARCHAR(255) DEFAULT "Unnamed Campaign",
    campaign_profile_image VARCHAR(255) DEFAULT "http://via.placeholder.com/300x300",
    campaign_created TIMESTAMP NOT NULL DEFAULT CURRENT_DATE,
    campaign_modified TIMESTAMP NOT NULL DEFAULT CURRENT_DATE,
    advertiser_id, INT,
    PRIMARY KEY (campaign_id),
    FOREIGN KEY (advertiser_id) REFERENCES advertisers(advertiser_id)
);

CREATE TABLE adsets
(
    adset_id INT NOT NULL AUTO_INCREMENT,
    adset_name VARCHAR(255) DEFAULT "Unnamed Adset",
    adset_created TIMESTAMP NOT NULL DEFAULT CURRENT_DATE,
    adset_modified TIMESTAMP NOT NULL DEFAULT CURRENT_DATE,
    campaign_id, INT,
    PRIMARY KEY (adset_id),
    FOREIGN KEY (campaign_id) REFERENCES campaigns(campaign_id)
);

CREATE TABLE ads
(
    ad_id INT NOT NULL AUTO_INCREMENT,
    ad_width INT,
    ad_height INT,
    ad_type VARCHAR(255),
    ad_path VARCHAR(255),
    ad_created TIMESTAMP NOT NULL DEFAULT CURRENT_DATE,
    ad_update TIMESTAMP NOT NULL DEFAULT CURRENT_DATE,
    adset_id INT,
    PRIMARY KEY (ad_id),
    FOREIGN KEY (adset_id) REFERENCES adsets(adset_id)    
)