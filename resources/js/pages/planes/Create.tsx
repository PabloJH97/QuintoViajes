import { PlaneForm } from "@/pages/planes/components/PlaneForm";
import { PlaneLayout } from "@/layouts/planes/PlaneLayout";
import { PageProps } from "@/types";
import { useTranslations } from "@/hooks/use-translations";

interface CreatePlaneProps extends PageProps {
    arrayPermissions?: string[];

  }

export default function CreatePlane({arrayPermissions}:CreatePlaneProps) {
  const { t } = useTranslations();

  return (
    <PlaneLayout title={t("ui.planes.create")}>
      <div className="p-6">
        <div className="max-w-xl">
          <PlaneForm pageTitle={t("ui.planes.create")} />
        </div>
      </div>
    </PlaneLayout>
  );
}
