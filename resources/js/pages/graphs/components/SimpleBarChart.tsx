import { useTranslations } from '@/hooks/use-translations';
import React, { PureComponent } from 'react';
import { BarChart, Bar, Rectangle, XAxis, YAxis, CartesianGrid, Tooltip, Legend, ResponsiveContainer } from 'recharts';
interface SimpleBarChartProps{
    data: any[];
}


export default function SimpleBarChart({data}: SimpleBarChartProps){
    const { t } = useTranslations();
    return (
      <ResponsiveContainer width="100%" height="100%">
        <BarChart
          width={500}
          height={300}
          data={data}
          margin={{
            top: 5,
            right: 30,
            left: 20,
            bottom: 5,
          }}
        >
          <CartesianGrid strokeDasharray="3 3" />
          <XAxis dataKey={data[0].hasOwnProperty('name')?"name":"code"}/>
          <YAxis allowDecimals={false}/>
          <Tooltip/>
          <Legend />
          {(data[0].hasOwnProperty('name')||data[0].hasOwnProperty('code'))&&<Bar dataKey="tickets_count" fill="#82ca9d" activeBar={<Rectangle fill="pink" stroke="blue" />} name={t(`ui.graphs.ticketsCount`)}/>}
        </BarChart>
      </ResponsiveContainer>
    );
}
