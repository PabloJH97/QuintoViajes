import { FlightForm } from "@/pages/flights/components/FlightForm";
import { FlightLayout } from "@/layouts/flights/FlightLayout";
import { PageProps } from "@inertiajs/core";
import { useTranslations } from "@/hooks/use-translations";

interface EditFlightProps extends PageProps {
  flight: {
    id: string;
    name: string;
    email: string;
  };
  page?: string;
  perPage?: string;
  planeCode: string;
}

export default function EditFlight({ flight, page, perPage, planeCode }: EditFlightProps) {
  const { t } = useTranslations();

  return (
    <FlightLayout title={t("ui.flights.edit")}>
      <div className="p-6">
        <div className="max-w-xl">
          <FlightForm
            initialData={flight}
            page={page}
            perPage={perPage}
            planeCode={planeCode}
            pageTitle={t("ui.flights.edit")}
          />
        </div>
      </div>
    </FlightLayout>
  );
}
