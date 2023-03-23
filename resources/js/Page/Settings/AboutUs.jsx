import React, { memo } from "react";
import Protected from "../../components/HOC/Protected";
import ContentLoad from "../../components/AboutUs";
import { getOptionValueByName } from "../../hooks/queries/settings/getOptionValueByName";

const AboutUs = () => {
    const {data: aboutUsValue, refetch:aboutUsRefetch} = getOptionValueByName('mlm_about_us', true)
    const {data: ourStoryValue, refetch:ourStoryRefetch} = getOptionValueByName('mlm_our_story', true)

    return (
        <>
            <div className="min-h-full">
                <div className="flex flex-1 flex-col lg:pl-64">
                    <main className="flex-1 py-8">
                        <div className="container">
                            <ContentLoad
                                title="Set About Us Content also upload Image"
                                optionName="mlm_about_us"
                                type='about_us'
                                data={aboutUsValue}
                                refetch={aboutUsRefetch}
                            />
                            <ContentLoad
                                title="Set our Story Content also upload Images"
                                optionName="mlm_our_story"
                                type='our_story'
                                data={ourStoryValue}
                                refetch={ourStoryRefetch}
                            />
                        </div>
                    </main>
                </div>
            </div>
        </>
    );
};

export default Protected(memo(AboutUs));

