import { FlightForm } from "@/pages/flights/components/FlightForm";
import { FlightLayout } from "@/layouts/flights/FlightLayout";
import { PageProps } from "@/types";
import { useTranslations } from "@/hooks/use-translations";

interface CreateFlightProps extends PageProps {
    arrayPermissions?: string[];

  }

export default function CreateFlight({arrayPermissions}:CreateFlightProps) {
  const { t } = useTranslations();

  return (
    <FlightLayout title={t("ui.flights.create")}>
      <div className="p-6">
        <div className="max-w-xl">
          <FlightForm arrayPermissions={arrayPermissions} pageTitle={t("ui.flights.create")} />
        </div>
      </div>
    </FlightLayout>
  );
}
